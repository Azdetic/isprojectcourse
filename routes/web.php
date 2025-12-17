<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\MyProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product-detail');

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
    Route::post('/reviews/{id}/helpful', [ReviewController::class, 'toggleHelpful'])->name('reviews.helpful');

    // My Products Routes
    Route::resource('my-products', MyProductController::class);
});
