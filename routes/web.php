<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

function getProducts() {
    return [
        [
            'name' => 'Nasi Goreng Spesial',
            'price' => 15000,
            'category' => 'Food',
            'seller' => 'Nisa S',
            'image' => 'https://images.unsplash.com/photo-1512058564366-18510be2db19?auto=format&fit=crop&q=80&w=800',
            'description' => 'Nasi goreng spesial dengan telur mata sapi dan kerupuk. Dibuat dengan bumbu rahasia keluarga.',
            'location' => 'Kantin Asrama Putri',
            'posted' => '1 hour ago',
            'rating' => 4.8,
            'reviews_count' => 2,
            'reviews' => [
                [
                    'user' => 'Andi S',
                    'initials' => 'AS',
                    'time' => '10 mins ago',
                    'rating' => 5,
                    'comment' => 'Enak banget nasgornya! Porsinya juga banyak.',
                    'helpful' => 2
                ],
                [
                    'user' => 'Budi G',
                    'initials' => 'BG',
                    'time' => '30 mins ago',
                    'rating' => 4,
                    'comment' => 'Lumayan, tapi agak pedes buat saya.',
                    'helpful' => 0
                ]
            ]
        ],
        [
            'name' => 'Laptop HP Pavilion',
            'price' => 4500000,
            'category' => 'Secondhand Goods',
            'seller' => 'Rizki',
            'image' => 'https://images.unsplash.com/photo-1496181133206-80ce9b88a853?auto=format&fit=crop&q=80&w=800',
            'description' => 'Laptop HP Pavilion bekas pemakaian wajar. Spesifikasi: Core i5, RAM 8GB, SSD 256GB. Masih mulus.',
            'location' => 'Gedung TULT',
            'posted' => '3 days ago',
            'rating' => 4.5,
            'reviews_count' => 1,
            'reviews' => [
                [
                    'user' => 'Citra L',
                    'initials' => 'CL',
                    'time' => '1 day ago',
                    'rating' => 5,
                    'comment' => 'Barang sesuai deskripsi, seller ramah.',
                    'helpful' => 1
                ]
            ]
        ],
        [
            'name' => 'Notebook Set Premium',
            'price' => 35000,
            'category' => 'Stationery',
            'seller' => 'Rafi K',
            'image' => 'https://images.unsplash.com/photo-1544816155-12df9643f363?auto=format&fit=crop&q=80&w=800',
            'description' => 'Set of 3 premium quality notebooks. 100 pages each, perfect for note-taking. Includes grid, lined, and blank pages.',
            'location' => 'Telkom University Campus',
            'posted' => '2 days ago',
            'rating' => 4.7,
            'reviews_count' => 3,
            'reviews' => [
                [
                    'user' => 'Sarah Wijaya',
                    'initials' => 'SW',
                    'time' => '3 days ago',
                    'rating' => 5,
                    'comment' => 'Great quality! The seller was very responsive and the item is exactly as described. Highly recommend!',
                    'helpful' => 12
                ],
                [
                    'user' => 'Rizky Pratama',
                    'initials' => 'RP',
                    'time' => '1 week ago',
                    'rating' => 5,
                    'comment' => 'Excellent service and fast delivery. The product exceeded my expectations. Will buy again!',
                    'helpful' => 8
                ],
                [
                    'user' => 'Budi Santoso',
                    'initials' => 'BS',
                    'time' => '2 weeks ago',
                    'rating' => 4,
                    'comment' => 'Good product overall. Minor wear and tear but still useful.',
                    'helpful' => 5
                ]
            ]
        ],
        [
            'name' => 'Seragam Telkom',
            'price' => 85000,
            'category' => 'Fashion',
            'seller' => 'Telkom Store',
            'image' => 'https://images.unsplash.com/photo-1591047139829-d91aecb6caea?auto=format&fit=crop&q=80&w=800',
            'description' => 'Seragam kemeja Telkom University ukuran L. Bahan adem dan nyaman dipakai.',
            'location' => 'Gedung Kuliah Umum',
            'posted' => '5 days ago',
            'rating' => 4.9,
            'reviews_count' => 20
        ],
        [
            'name' => 'Web Design Service',
            'price' => 500000,
            'category' => 'Digital Services',
            'seller' => 'Devano',
            'image' => 'https://images.unsplash.com/photo-1547658719-da2b51169166?auto=format&fit=crop&q=80&w=800',
            'description' => 'Jasa pembuatan desain website responsif dan modern. Pengerjaan cepat dan revisi sepuasnya.',
            'location' => 'Online',
            'posted' => '1 week ago',
            'rating' => 5.0,
            'reviews_count' => 8
        ],
        [
            'name' => 'Ayam Geprek Crispy',
            'price' => 18000,
            'category' => 'Food',
            'seller' => 'Maya G',
            'image' => 'https://images.unsplash.com/photo-1626082927389-6cd097cdc6ec?auto=format&fit=crop&q=80&w=800',
            'description' => 'Ayam geprek crispy dengan sambal bawang pedas nampol. Sudah termasuk nasi dan es teh.',
            'location' => 'Kantin Teknik',
            'posted' => '2 hours ago',
            'rating' => 4.6,
            'reviews_count' => 15
        ],
        [
            'name' => 'Headphone Sony WH-1000XM4',
            'price' => 3200000,
            'category' => 'Secondhand Goods',
            'seller' => 'Sarah',
            'image' => 'https://images.unsplash.com/photo-1618366712010-f4ae9c647dcb?auto=format&fit=crop&q=80&w=800',
            'description' => 'Headphone Sony WH-1000XM4 bekas. Noise cancelling mantap, baterai awet. Lengkap dengan box.',
            'location' => 'Asrama Putra',
            'posted' => '4 days ago',
            'rating' => 4.8,
            'reviews_count' => 10
        ],
        [
            'name' => 'Pulpen Pilot Set',
            'price' => 25000,
            'category' => 'Stationery',
            'seller' => 'ATK Campus',
            'image' => 'https://images.unsplash.com/photo-1585336261022-680e295ce3fe?auto=format&fit=crop&q=80&w=800',
            'description' => 'Set pulpen Pilot 3 warna (Hitam, Biru, Merah). Tinta lancar dan enak dipakai menulis.',
            'location' => 'Koperasi Mahasiswa',
            'posted' => '1 day ago',
            'rating' => 4.5,
            'reviews_count' => 45
        ],
        [
            'name' => 'Jaket Hoodie Premium',
            'price' => 150000,
            'category' => 'Fashion',
            'seller' => 'Telkom Store',
            'image' => 'https://images.unsplash.com/photo-1556905055-8f358a7a47b2?auto=format&fit=crop&q=80&w=800',
            'description' => 'Jaket hoodie bahan cotton fleece tebal. Sablon plastisol awet. Tersedia ukuran M, L, XL.',
            'location' => 'Gedung TULT',
            'posted' => '6 days ago',
            'rating' => 4.7,
            'reviews_count' => 25
        ],
        [
            'name' => 'Graphic Design Service',
            'price' => 250000,
            'category' => 'Digital Services',
            'seller' => 'Amanda',
            'image' => 'https://images.unsplash.com/photo-1626785774573-4b799314346d?auto=format&fit=crop&q=80&w=800',
            'description' => 'Jasa desain grafis untuk poster, banner, feed IG, dll. Kreatif dan profesional.',
            'location' => 'Online',
            'posted' => '2 weeks ago',
            'rating' => 4.9,
            'reviews_count' => 18
        ],
        [
            'name' => 'Kopi Susu Gula Aren',
            'price' => 12000,
            'category' => 'Food',
            'seller' => 'Tel-U Coffee',
            'image' => 'https://images.unsplash.com/photo-1541167760496-1628856ab772?auto=format&fit=crop&q=80&w=800',
            'description' => 'Kopi susu gula aren kekinian. Rasa kopi strong, manis pas. Cocok buat nemenin nugas.',
            'location' => 'Gedung Bangkit',
            'posted' => '30 mins ago',
            'rating' => 4.8,
            'reviews_count' => 50
        ],
        [
            'name' => 'Calculus Textbook',
            'price' => 120000,
            'category' => 'Secondhand Goods',
            'seller' => 'Ahmad',
            'image' => 'https://images.unsplash.com/photo-1544947950-fa07a98d237f?auto=format&fit=crop&q=80&w=800',
            'description' => 'Buku Kalkulus edisi 9 jilid 1. Kondisi masih bagus, tidak ada coretan.',
            'location' => 'Perpustakaan',
            'posted' => '1 week ago',
            'rating' => 4.6,
            'reviews_count' => 7
        ],
    ];
}

Route::get('/products', function () {
    $products = getProducts();
    return view('products', compact('products'));
})->name('products');

Route::get('/product/{id}', function ($id) {
    $products = getProducts();
    if (!isset($products[$id])) {
        abort(404);
    }
    $product = $products[$id];
    return view('product-detail', compact('product'));
})->name('product-detail');

// Auth Routes
Route::get('/signup', [AuthController::class, 'showSignup'])->name('signup');
Route::post('/signup', [AuthController::class, 'signup'])->name('signup.store');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.store');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
