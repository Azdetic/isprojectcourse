<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

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

        $products = Product::where('name', 'LIKE', "%{$query}%")
            ->orWhere('category', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->limit(10)
            ->get(['id', 'name', 'category', 'price', 'image']);

        return response()->json($products);
    }

    public function index(Request $request)
    {
        $search = $request->get('search');
        $category = $request->get('category');

        $query = Product::query();

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('category', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%");
            });
        }

        if ($category) {
            $query->where('category', $category);
        }

        $products = $query->paginate(12);

        return view('products', compact('products', 'search', 'category'));
    }

    public function show($id)
    {
        $product = Product::find($id);
        if (!$product) {
            abort(404);
        }

        // Fetch reviews from database
        $dbReviews = Review::where('product_id', $id)->with(['user', 'votes'])->latest()->get();

        // Format database reviews to match the view's expected structure
        $formattedReviews = $dbReviews->map(function ($review) {
            $userName = $review->user->name;
            $initials = substr($userName, 0, 2);

            if ($review->is_anonymous) {
                $userName = substr($userName, 0, 2) . '***';
                $initials = '??';
            }

            return [
                'id' => $review->id,
                'user' => $userName,
                'initials' => $initials,
                'time' => $review->created_at->diffForHumans(),
                'rating' => $review->rating,
                'comment' => $review->comment,
                'helpful' => $review->votes->count()
            ];
        })->toArray();

        // Assign formatted reviews to the product object for the view
        $product['reviews'] = $formattedReviews;

        // Recalculate rating and count
        $totalReviews = count($product['reviews']);
        $starCounts = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0];

        if ($totalReviews > 0) {
            $sumRating = array_reduce($product['reviews'], function($carry, $item) use (&$starCounts) {
                $rating = round($item['rating']);
                if (isset($starCounts[$rating])) {
                    $starCounts[$rating]++;
                }
                return $carry + $item['rating'];
            }, 0);
            $product['rating'] = round($sumRating / $totalReviews, 1);
            $product['reviews_count'] = $totalReviews;
        } else {
            $product['rating'] = 0;
            $product['reviews_count'] = 0;
        }

        // Calculate percentages
        $starPercentages = [];
        foreach ($starCounts as $star => $count) {
            $starPercentages[$star] = $totalReviews > 0 ? round(($count / $totalReviews) * 100) : 0;
        }
        $product['star_percentages'] = $starPercentages;

        return view('product-detail', compact('product'));
    }
}
