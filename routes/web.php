<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

use App\Models\Product;
use App\Models\Review;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/products', function () {
    $products = Product::getAll();
    return view('products', compact('products'));
})->name('products');

Route::get('/product/{id}', function ($id) {
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
            'id' => $review->id, // Add ID for helpful toggle
            'user' => $userName,
            'initials' => $initials,
            'time' => $review->created_at->diffForHumans(),
            'rating' => $review->rating,
            'comment' => $review->comment,
            'helpful' => $review->votes->count() // Count votes
        ];
    })->toArray();

    // Assign formatted reviews to the product object for the view
    // Since we migrated to DB, we don't need to merge with static reviews anymore
    $product['reviews'] = $formattedReviews;

    // Recalculate rating and count
    $totalReviews = count($product['reviews']);
    $starCounts = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0];

    if ($totalReviews > 0) {
        $sumRating = array_reduce($product['reviews'], function($carry, $item) use (&$starCounts) {
            $rating = round($item['rating']); // Ensure integer key
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
})->name('product-detail');

// Auth Routes
Route::get('/signup', [AuthController::class, 'showSignup'])->name('signup');
Route::post('/signup', [AuthController::class, 'signup'])->name('signup.store');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.store');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::get('/add-to-cart/{id}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::patch('/update-cart', [CartController::class, 'updateCart'])->name('cart.update');
    Route::delete('/remove-from-cart/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');

    // Order Routes
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::post('/checkout', [OrderController::class, 'checkout'])->name('orders.checkout');
    Route::patch('/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');

    // Review Routes
    Route::post('/reviews', [OrderController::class, 'storeReview'])->name('reviews.store');
    Route::post('/reviews/{id}/helpful', [App\Http\Controllers\ReviewController::class, 'toggleHelpful'])->name('reviews.helpful');

    // My Products Routes
    Route::resource('my-products', App\Http\Controllers\MyProductController::class);
});
