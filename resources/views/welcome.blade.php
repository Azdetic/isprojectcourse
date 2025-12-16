<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TMarket - Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
        }
        .t-red { color: #D12026; }
        .bg-t-red { background-color: #D12026; }
        .border-t-red { border-color: #D12026; }
        .btn-outline-red {
            border: 1px solid #D12026;
            color: #D12026;
        }
        .btn-outline-red:hover {
            background-color: #D12026;
            color: white;
        }
    </style>
</head>
<body class="bg-gray-50">

    <!-- Navbar -->
    @include('components.navbar')

    <!-- Hero Section -->
    <div class="relative bg-gray-900 h-[400px] overflow-hidden">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0">
            <img src="{{ asset('images/telkomuniv.jpg') }}" alt="Campus Background" class="w-full h-full object-cover opacity-40">
            <div class="absolute inset-0 bg-gradient-to-r from-black/80 to-transparent"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex items-center">
            <div class="max-w-xl text-white">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Welcome to <span class="t-red">TMarket</span></h1>
                <p class="text-lg md:text-xl text-gray-200 mb-8">The official marketplace for Telkom University students. Buy, sell, and connect with your campus community.</p>
                <div class="flex space-x-4">
                    <a href="{{ route('products') }}" class="bg-t-red hover:bg-red-700 text-white px-8 py-3 rounded-lg font-medium transition duration-300">Shop Now</a>
                    <a href="#" class="bg-white text-gray-900 hover:bg-gray-100 px-8 py-3 rounded-lg font-medium transition duration-300">Sell Item</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Categories Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Browse Categories</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
            <!-- Category Item -->
            <a href="#" class="group bg-white p-4 rounded-xl shadow-sm hover:shadow-md transition border border-gray-100 text-center">
                <div class="w-12 h-12 mx-auto bg-red-50 rounded-full flex items-center justify-center mb-3 group-hover:bg-red-100 transition">
                    <i class="fas fa-book text-t-red text-xl"></i>
                </div>
                <span class="text-sm font-medium text-gray-700 group-hover:text-t-red">Books</span>
            </a>
            <a href="#" class="group bg-white p-4 rounded-xl shadow-sm hover:shadow-md transition border border-gray-100 text-center">
                <div class="w-12 h-12 mx-auto bg-red-50 rounded-full flex items-center justify-center mb-3 group-hover:bg-red-100 transition">
                    <i class="fas fa-laptop text-t-red text-xl"></i>
                </div>
                <span class="text-sm font-medium text-gray-700 group-hover:text-t-red">Electronics</span>
            </a>
            <a href="#" class="group bg-white p-4 rounded-xl shadow-sm hover:shadow-md transition border border-gray-100 text-center">
                <div class="w-12 h-12 mx-auto bg-red-50 rounded-full flex items-center justify-center mb-3 group-hover:bg-red-100 transition">
                    <i class="fas fa-tshirt text-t-red text-xl"></i>
                </div>
                <span class="text-sm font-medium text-gray-700 group-hover:text-t-red">Fashion</span>
            </a>
            <a href="#" class="group bg-white p-4 rounded-xl shadow-sm hover:shadow-md transition border border-gray-100 text-center">
                <div class="w-12 h-12 mx-auto bg-red-50 rounded-full flex items-center justify-center mb-3 group-hover:bg-red-100 transition">
                    <i class="fas fa-couch text-t-red text-xl"></i>
                </div>
                <span class="text-sm font-medium text-gray-700 group-hover:text-t-red">Furniture</span>
            </a>
            <a href="#" class="group bg-white p-4 rounded-xl shadow-sm hover:shadow-md transition border border-gray-100 text-center">
                <div class="w-12 h-12 mx-auto bg-red-50 rounded-full flex items-center justify-center mb-3 group-hover:bg-red-100 transition">
                    <i class="fas fa-utensils text-t-red text-xl"></i>
                </div>
                <span class="text-sm font-medium text-gray-700 group-hover:text-t-red">Food</span>
            </a>
            <a href="#" class="group bg-white p-4 rounded-xl shadow-sm hover:shadow-md transition border border-gray-100 text-center">
                <div class="w-12 h-12 mx-auto bg-red-50 rounded-full flex items-center justify-center mb-3 group-hover:bg-red-100 transition">
                    <i class="fas fa-ellipsis-h text-t-red text-xl"></i>
                </div>
                <span class="text-sm font-medium text-gray-700 group-hover:text-t-red">Others</span>
            </a>
        </div>
    </div>

    <!-- Trending Products -->
    <div class="bg-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-900">Trending Now</h2>
                <a href="#" class="text-t-red font-medium hover:text-red-700">View All <i class="fas fa-arrow-right ml-1"></i></a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <!-- Product Card 1 -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-lg transition duration-300 overflow-hidden group">
                    <div class="relative h-48 bg-gray-200">
                        <img src="https://images.unsplash.com/photo-1544947950-fa07a98d237f?auto=format&fit=crop&q=80&w=800" alt="Product" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                        <div class="absolute top-2 right-2">
                            <button class="bg-white p-2 rounded-full shadow-sm hover:text-red-500 transition">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                        <div class="absolute top-2 left-2 bg-t-red text-white text-xs font-bold px-2 py-1 rounded">
                            NEW
                        </div>
                    </div>
                    <div class="p-4">
                        <div class="text-xs text-gray-500 mb-1">Books</div>
                        <h3 class="font-semibold text-gray-900 mb-1 truncate">Calculus 9th Edition</h3>
                        <div class="flex items-center mb-2">
                            <div class="flex text-yellow-400 text-xs">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <span class="text-xs text-gray-500 ml-1">(24)</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-lg font-bold text-t-red">Rp 150.000</span>
                            <button class="text-gray-400 hover:text-t-red transition">
                                <i class="fas fa-plus-circle text-2xl"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Product Card 2 -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-lg transition duration-300 overflow-hidden group">
                    <div class="relative h-48 bg-gray-200">
                        <img src="https://images.unsplash.com/photo-1496181133206-80ce9b88a853?auto=format&fit=crop&q=80&w=800" alt="Product" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                        <div class="absolute top-2 right-2">
                            <button class="bg-white p-2 rounded-full shadow-sm hover:text-red-500 transition">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                    </div>
                    <div class="p-4">
                        <div class="text-xs text-gray-500 mb-1">Electronics</div>
                        <h3 class="font-semibold text-gray-900 mb-1 truncate">MacBook Pro 2019</h3>
                        <div class="flex items-center mb-2">
                            <div class="flex text-yellow-400 text-xs">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <span class="text-xs text-gray-500 ml-1">(12)</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-lg font-bold text-t-red">Rp 12.500.000</span>
                            <button class="text-gray-400 hover:text-t-red transition">
                                <i class="fas fa-plus-circle text-2xl"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Product Card 3 -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-lg transition duration-300 overflow-hidden group">
                    <div class="relative h-48 bg-gray-200">
                        <img src="https://images.unsplash.com/photo-1555041469-a586c61ea9bc?auto=format&fit=crop&q=80&w=800" alt="Product" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                        <div class="absolute top-2 right-2">
                            <button class="bg-white p-2 rounded-full shadow-sm hover:text-red-500 transition">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                    </div>
                    <div class="p-4">
                        <div class="text-xs text-gray-500 mb-1">Furniture</div>
                        <h3 class="font-semibold text-gray-900 mb-1 truncate">Study Desk Minimalist</h3>
                        <div class="flex items-center mb-2">
                            <div class="flex text-yellow-400 text-xs">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <i class="far fa-star"></i>
                            </div>
                            <span class="text-xs text-gray-500 ml-1">(8)</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-lg font-bold text-t-red">Rp 450.000</span>
                            <button class="text-gray-400 hover:text-t-red transition">
                                <i class="fas fa-plus-circle text-2xl"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Product Card 4 -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-lg transition duration-300 overflow-hidden group">
                    <div class="relative h-48 bg-gray-200">
                        <img src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?auto=format&fit=crop&q=80&w=800" alt="Product" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                        <div class="absolute top-2 right-2">
                            <button class="bg-white p-2 rounded-full shadow-sm hover:text-red-500 transition">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                        <div class="absolute top-2 left-2 bg-gray-800 text-white text-xs font-bold px-2 py-1 rounded">
                            SOLD
                        </div>
                    </div>
                    <div class="p-4">
                        <div class="text-xs text-gray-500 mb-1">Electronics</div>
                        <h3 class="font-semibold text-gray-900 mb-1 truncate">Smart Watch Series 5</h3>
                        <div class="flex items-center mb-2">
                            <div class="flex text-yellow-400 text-xs">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <span class="text-xs text-gray-500 ml-1">(42)</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-lg font-bold text-t-red">Rp 2.100.000</span>
                            <button class="text-gray-400 hover:text-t-red transition" disabled>
                                <i class="fas fa-plus-circle text-2xl"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    @include('components.footer')

</body>
</html>
