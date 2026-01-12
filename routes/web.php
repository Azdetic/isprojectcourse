<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\MyProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PlaceholderController;
use App\Http\Controllers\LegalController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AboutController;

Route::get('/', [ProductController::class, 'home'])->name('home');

Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');
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

    Route::get('/sales', [App\Http\Controllers\SalesController::class, 'index'])->name('sales.index');
    
    // Chat Routes
    Route::get('/chat', [\App\Http\Controllers\ChatController::class, 'index'])->name('chat.index');
    Route::get('/chat/{userId}', [\App\Http\Controllers\ChatController::class, 'show'])->name('chat.show');
    Route::post('/chat/{conversationId}', [\App\Http\Controllers\ChatController::class, 'store'])->name('chat.store');

    // Placeholder Routes
    Route::get('/seller/{id}/profile', [PlaceholderController::class, 'comingSoon'])->name('seller.profile');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');

    // Users
    Route::get('/users', [AdminController::class, 'users'])->name('users.index');
    Route::delete('/users/{id}', [AdminController::class, 'destroyUser'])->name('users.destroy');

    // Orders
    Route::get('/orders', [AdminController::class, 'orders'])->name('orders.index');
    Route::patch('/orders/{id}/approve', [AdminController::class, 'approveOrder'])->name('orders.approve');
    Route::patch('/orders/{id}/reject', [AdminController::class, 'rejectOrder'])->name('orders.reject');
    Route::patch('/orders/{id}/ship', [AdminController::class, 'shipOrder'])->name('orders.ship');

    // Products
    Route::get('/products', [AdminController::class, 'products'])->name('products.index');
    Route::delete('/products/{id}', [AdminController::class, 'destroyProduct'])->name('products.destroy');
});


// Legal Routes
Route::get('/privacy-policy', [LegalController::class, 'privacy'])->name('legal.privacy');
Route::get('/terms-of-service', [LegalController::class, 'terms'])->name('legal.terms');

// Public "About" Page
Route::get('/about', [AboutController::class, 'index'])->name('about.index');

// Management Routes (Protected for admins only)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/about/manage', [AboutController::class, 'manage'])->name('about.manage');
    Route::post('/about/store', [AboutController::class, 'store'])->name('about.store');
    Route::put('/about/update/{id}', [AboutController::class, 'update'])->name('about.update');
    Route::delete('/about/delete/{id}', [AboutController::class, 'destroy'])->name('about.destroy');
});
