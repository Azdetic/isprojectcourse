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
            <a href="{{ route('products', ['search' => 'Books']) }}" class="group bg-white p-4 rounded-xl shadow-sm hover:shadow-md transition border border-gray-100 text-center">
                <div class="w-12 h-12 mx-auto bg-red-50 rounded-full flex items-center justify-center mb-3 group-hover:bg-red-100 transition">
                    <i class="fas fa-book text-t-red text-xl"></i>
                </div>
                <span class="text-sm font-medium text-gray-700 group-hover:text-t-red">Books</span>
            </a>
            <a href="{{ route('products', ['search' => 'Electronics']) }}" class="group bg-white p-4 rounded-xl shadow-sm hover:shadow-md transition border border-gray-100 text-center">
                <div class="w-12 h-12 mx-auto bg-red-50 rounded-full flex items-center justify-center mb-3 group-hover:bg-red-100 transition">
                    <i class="fas fa-laptop text-t-red text-xl"></i>
                </div>
                <span class="text-sm font-medium text-gray-700 group-hover:text-t-red">Electronics</span>
            </a>
            <a href="{{ route('products', ['search' => 'Fashion']) }}" class="group bg-white p-4 rounded-xl shadow-sm hover:shadow-md transition border border-gray-100 text-center">
                <div class="w-12 h-12 mx-auto bg-red-50 rounded-full flex items-center justify-center mb-3 group-hover:bg-red-100 transition">
                    <i class="fas fa-tshirt text-t-red text-xl"></i>
                </div>
                <span class="text-sm font-medium text-gray-700 group-hover:text-t-red">Fashion</span>
            </a>
            <a href="{{ route('products', ['search' => 'Stationery']) }}" class="group bg-white p-4 rounded-xl shadow-sm hover:shadow-md transition border border-gray-100 text-center">
                <div class="w-12 h-12 mx-auto bg-red-50 rounded-full flex items-center justify-center mb-3 group-hover:bg-red-100 transition">
                    <i class="fas fa-couch text-t-red text-xl"></i>
                </div>
                <span class="text-sm font-medium text-gray-700 group-hover:text-t-red">Stationery</span>
            </a>
            <a href="{{ route('products', ['search' => 'Food']) }}" class="group bg-white p-4 rounded-xl shadow-sm hover:shadow-md transition border border-gray-100 text-center">
                <div class="w-12 h-12 mx-auto bg-red-50 rounded-full flex items-center justify-center mb-3 group-hover:bg-red-100 transition">
                    <i class="fas fa-utensils text-t-red text-xl"></i>
                </div>
                <span class="text-sm font-medium text-gray-700 group-hover:text-t-red">Food</span>
            </a>
            <a href="{{ route('products', ['search' => 'Other']) }}" class="group bg-white p-4 rounded-xl shadow-sm hover:shadow-md transition border border-gray-100 text-center">
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
                <a href="{{ route('products') }}" class="text-t-red font-medium hover:text-red-700">View All <i class="fas fa-arrow-right ml-1"></i></a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse($trendingProducts as $product)
                    <!-- Product Card -->
                    <a href="{{ route('product-detail', $product->id) }}" class="block bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-lg transition duration-300 overflow-hidden group cursor-pointer">
                        <div class="relative h-48 bg-gray-200">
                            @if($product->image)
                                @if(Str::startsWith($product->image, 'http'))
                                    <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300" onerror="this.src='https://via.placeholder.com/400x300?text=No+Image'">
                                @else
                                    <img src="{{ asset(ltrim($product->image, '/')) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300" onerror="this.src='https://via.placeholder.com/400x300?text=No+Image'">
                                @endif
                            @else
                                <img src="https://via.placeholder.com/400x300?text=No+Image" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                            @endif
                            <div class="absolute top-2 right-2">
                                <button class="bg-white p-2 rounded-full shadow-sm hover:text-red-500 transition" onclick="event.preventDefault(); event.stopPropagation();">
                                    <i class="far fa-heart"></i>
                                </button>
                            </div>
                            <div class="absolute top-2 left-2 bg-t-red text-white text-xs font-bold px-2 py-1 rounded">
                                NEW
                            </div>
                        </div>
                        <div class="p-4">
                            <div class="text-xs text-gray-500 mb-1">{{ $product->category }}</div>
                            <h3 class="font-semibold text-gray-900 mb-1 truncate">{{ $product->name }}</h3>
                            <div class="flex items-center mb-2">
                                <div class="flex text-yellow-400 text-xs">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= round($product->rating))
                                            <i class="fas fa-star"></i>
                                        @elseif($i - 0.5 <= $product->rating)
                                            <i class="fas fa-star-half-alt"></i>
                                        @else
                                            <i class="far fa-star"></i>
                                        @endif
                                    @endfor
                                </div>
                                <span class="text-xs text-gray-500 ml-1">({{ $product->reviews_count }})</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-lg font-bold text-t-red">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                <div class="text-gray-400">
                                    <i class="fas fa-plus-circle text-2xl"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full text-center py-10">
                        <div class="mb-4">
                            <i class="fas fa-box-open text-gray-300 text-6xl"></i>
                        </div>
                        <p class="text-gray-500 text-lg">No products available yet.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Footer -->
    @include('components.footer')

    <script>
        // Debounce function to limit API calls
        function debounce(func, wait) {
            let timeout;
            return function executedFunction(...args) {
                const later = () => {
                    clearTimeout(timeout);
                    func(...args);
                };
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
            };
        }

        // Search functionality
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search-input');
            const searchResults = document.getElementById('search-results');
            const searchResultsContent = document.getElementById('search-results-content');

            if (!searchInput) return;

            // Debounced search function
            const debouncedSearch = debounce(async function(query) {
                if (query.length < 2) {
                    searchResults.classList.add('hidden');
                    return;
                }

                try {
                    const response = await fetch(`/products/search?q=${encodeURIComponent(query)}`);
                    const products = await response.json();

                    if (products.length > 0) {
                        const resultsHtml = products.map(product => `
                            <a href="/product/${product.id}" class="block px-4 py-3 hover:bg-gray-50 border-b border-gray-100 last:border-b-0">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-gray-200 rounded-lg overflow-hidden flex-shrink-0">
                                        <img src="${product.image.startsWith('http') ? product.image : '/storage/' + product.image}"
                                             alt="${product.name}"
                                             class="w-full h-full object-cover"
                                             onerror="this.src='https://via.placeholder.com/40x40?text=No+Image'">
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="font-medium text-gray-900 truncate">${product.name}</div>
                                        <div class="text-sm text-gray-500">${product.category}</div>
                                    </div>
                                    <div class="text-right">
                                        <div class="font-bold text-[#B91C1C]">Rp ${new Intl.NumberFormat('id-ID').format(product.price)}</div>
                                    </div>
                                </div>
                            </a>
                        `).join('');

                        searchResultsContent.innerHTML = resultsHtml;
                        searchResults.classList.remove('hidden');
                    } else {
                        searchResultsContent.innerHTML = `
                            <div class="px-4 py-3 text-gray-500 text-center">
                                No products found for "${query}"
                            </div>
                        `;
                        searchResults.classList.remove('hidden');
                    }
                } catch (error) {
                    console.error('Search error:', error);
                    searchResults.classList.add('hidden');
                }
            }, 300); // 300ms debounce

            // Input event listener
            searchInput.addEventListener('input', function(e) {
                const query = e.target.value.trim();
                debouncedSearch(query);
            });

            // Focus event to show results if there's a query
            searchInput.addEventListener('focus', function() {
                const query = searchInput.value.trim();
                if (query.length >= 2) {
                    debouncedSearch(query);
                }
            });

            // Hide results when clicking outside
            document.addEventListener('click', function(e) {
                if (!searchInput.contains(e.target) && !searchResults.contains(e.target)) {
                    searchResults.classList.add('hidden');
                }
            });

            // Hide results on escape key
            searchInput.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    searchResults.classList.add('hidden');
                    searchInput.blur();
                }
            });
        });
    </script>
</body>
</html>
