<?php

namespace App\Observers;

use App\Models\Review;
use App\Models\Product;

class ReviewObserver
{
    /**
     * Handle the Review "created" event.
     *
     * @param  \App\Models\Review  $review
     * @return void
     */
    public function created(Review $review)
    {
        $this->updateProductStatsForReview($review);
    }

    /**
     * Handle the Review "updated" event.
     *
     * @param  \App\Models\Review  $review
     * @return void
     */
    public function updated(Review $review)
    {
        $this->updateProductStatsForReview($review);
    }

    /**
     * Handle the Review "deleted" event.
     *
     * @param  \App\Models\Review  $review
     * @return void
     */
    public function deleted(Review $review)
    {
        $this->updateProductStatsForReview($review);
    }

    /**
     * Safely finds the product related to the review and triggers the update.
     *
     * @param Review $review
     */
    protected function updateProductStatsForReview(Review $review)
    {
        // The product might not be loaded on the review model in all observer contexts.
        // We'll load it manually using the foreign key to be safe.
        $product = Product::find($review->product_id);

        if ($product) {
            $this->updateProductStats($product);
        }
    }


    /**
     * Update the product's rating and reviews count.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    protected function updateProductStats(Product $product)
    {
        $product->reviews_count = $product->reviews()->count();
        $product->rating = $product->reviews()->avg('rating') ?? 0;
        $product->save();
    }
}
