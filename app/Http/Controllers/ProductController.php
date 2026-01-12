<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function home()
    {
        // Get trending products (latest 4 products for homepage)
        $trendingProducts = Product::latest()->take(4)->get();
        return view('welcome', compact('trendingProducts'));
    }

    public function search(Request $request)
    {
        $query = $request->get('q', '');

        if (strlen($query) < 2) {
            return response()->json([]);
        }

        // Use Scout for searching
        $products = Product::search($query)
            ->take(10)
            ->get(['id', 'name', 'category', 'price', 'image']);

        return response()->json($products);
    }

    public function index(Request $request)
    {
        $search = $request->get('search');
        $category = $request->get('category');

        // Start with Scout search if a search term is provided
        if ($search) {
            $query = Product::search($search);
        } else {
            $query = Product::query();
        }

        // Add category filtering if a category is selected
        if ($category) {
            $query->where('category', $category);
        }

        $products = $query->paginate(12);

        return view('products', compact('products', 'search', 'category'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);

        // Fetch reviews and format them for the view
        $reviews = Review::where('product_id', $id)->with('user', 'votes')->latest()->get()->map(function ($review) {
            $userName = $review->is_anonymous ? substr($review->user->name, 0, 2) . '***' : $review->user->name;
            $initials = $review->is_anonymous ? '??' : substr($review->user->name, 0, 2);

            return [
                'id' => $review->id,
                'user' => $userName,
                'initials' => $initials,
                'time' => $review->created_at->diffForHumans(),
                'rating' => $review->rating,
                'comment' => $review->comment,
                'helpful' => $review->votes->count()
            ];
        });

        // The 'rating' and 'reviews_count' are now directly on the $product model
        // We still need to calculate star percentages for the detail view chart
        $totalReviews = $product->reviews_count;
        $starCounts = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0];

        foreach ($product->reviews as $review) {
            $rating = round($review->rating);
            if (isset($starCounts[$rating])) {
                $starCounts[$rating]++;
            }
        }
        
        $starPercentages = [];
        foreach ($starCounts as $star => $count) {
            $starPercentages[$star] = $totalReviews > 0 ? round(($count / $totalReviews) * 100) : 0;
        }

        $reviewableOrder = null;
        if (Auth::check()) {
            $reviewableOrder = Order::where('user_id', Auth::id())
                ->where('status', 'completed')
                ->whereHas('items', function ($query) use ($product) {
                    $query->where('product_id', $product->id);
                })
                ->whereDoesntHave('reviews', function ($query) use ($product) {
                    $query->where('product_id', $product->id);
                })
                ->first();
        }

        return view('product-detail', compact('product', 'reviews', 'starPercentages', 'reviewableOrder'));
    }
}
