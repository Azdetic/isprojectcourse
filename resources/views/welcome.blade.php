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
    <div class="relative h-[550px] w-full bg-white group">
        <div class="absolute inset-0 clip-hero z-0 overflow-hidden">
            <div class="absolute inset-0 bg-cover bg-center transition-transform duration-[10s] group-hover:scale-105" 
                 style="background-image: url('{{ asset('images/telkomuniv.jpg') }}');">
            </div>
            <div class="absolute inset-0 bg-gradient-to-r from-[#B91C1C]/95 via-red-900/80 to-slate-900/60 mix-blend-multiply"></div>
            <div class="absolute inset-0 opacity-20 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] mix-blend-overlay"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex flex-col justify-center pb-10">
            <div class="max-w-3xl animate-fade-in-up">
                <div class="inline-flex items-center gap-2 py-1.5 px-4 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-white text-xs font-bold uppercase tracking-wider mb-6 shadow-sm">
                    <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>
                    Official Marketplace for Telkom University
                </div>
                
                <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-6 leading-tight drop-shadow-lg">
                    Buy, Sell, & Connect <br/>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-100 via-white to-red-100">With Your Campus.</span>
                </h1>
                
                <p class="text-lg md:text-xl text-red-50 mb-8 max-w-xl leading-relaxed font-medium text-shadow">
                    The safest way to trade textbooks, electronics, and dorm essentials directly with other students.
                </p>
                
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('products') }}" class="px-8 py-4 bg-white text-[#B91C1C] rounded-xl font-bold hover:bg-gray-50 transition shadow-xl shadow-red-900/20 transform hover:-translate-y-1 flex items-center justify-center gap-2">
                        <span>Start Shopping</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                    <a href="#" class="px-8 py-4 bg-transparent border-2 border-white/30 text-white rounded-xl font-bold hover:bg-white/10 backdrop-blur-sm transition flex items-center justify-center">
                        Sell an Item
                    </a>
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