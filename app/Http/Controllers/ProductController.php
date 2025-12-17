<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products', compact('products'));
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
