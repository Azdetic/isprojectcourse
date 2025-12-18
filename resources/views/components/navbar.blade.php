<nav class="bg-white shadow-sm sticky top-0 z-50 border-b border-gray-100 font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20 items-center">

            <div class="flex items-center gap-8">
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center gap-3">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10 w-auto object-contain">

                        <span class="text-2xl font-extrabold text-[#B91C1C] tracking-tight uppercase">TMARKET</span>
                    </a>
                </div>

                <div class="hidden md:flex space-x-6">
                    <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-[#B91C1C] font-bold' : 'text-gray-500 hover:text-[#B91C1C] font-medium transition' }}">Home</a>
                    <a href="{{ route('products') }}" class="{{ request()->routeIs('products') ? 'text-[#B91C1C] font-bold' : 'text-gray-500 hover:text-[#B91C1C] font-medium transition' }}">Products</a>
                    <a href="{{ route('about.index') }}" class="{{ request()->routeIs('about.index') ? 'text-[#B91C1C] font-bold' : 'text-gray-500 hover:text-[#B91C1C] font-medium transition' }}">About</a>
                </div>
            </div>

            <div class="flex-1 max-w-lg mx-8 hidden md:block">
                <form action="{{ route('products') }}" method="GET" class="relative group">
                    <input type="text" name="search" id="search-input" placeholder="Search for books, electronics..."
                        class="w-full pl-11 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-full focus:outline-none focus:border-[#B91C1C] focus:ring-1 focus:ring-[#B91C1C] text-sm transition-all group-hover:bg-white group-hover:shadow-sm"
                        value="{{ request('search') }}">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400 group-hover:text-[#B91C1C] transition"></i>
                    </div>

                    <!-- Search Results Dropdown -->
                    <div id="search-results" class="absolute top-full left-0 right-0 mt-2 bg-white border border-gray-200 rounded-lg shadow-lg z-50 hidden max-h-96 overflow-y-auto">
                        <div id="search-results-content"></div>
                    </div>
                </form>
            </div>

            <div class="flex items-center space-x-5">
                <a href="{{ route('orders.index') }}" class="text-gray-500 hover:text-[#B91C1C] relative transition p-2 rounded-full hover:bg-red-50" title="My Orders">
                    <i class="fas fa-clipboard-list text-lg"></i>
                </a>
                <a href="{{ route('cart.index') }}" class="text-gray-500 hover:text-[#B91C1C] relative transition p-2 rounded-full hover:bg-red-50" title="Cart">
                    <i class="fas fa-shopping-cart text-lg"></i>
                </a>

                @auth
                    <div class="relative ml-2 group z-50">
                        <div class="flex items-center space-x-2 cursor-pointer py-2">
                            <img class="h-9 w-9 rounded-full object-cover border-2 border-white shadow-sm"
                                 src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=B91C1C&color=fff&bold=true"
                                 alt="{{ Auth::user()->name }}">
                            <div class="hidden sm:flex flex-col items-start leading-tight">
                                <span class="text-sm font-bold text-gray-800">{{ Auth::user()->name }}</span>
                                <span class="text-[10px] text-gray-500">{{ Auth::user()->is_admin ? 'Admin' : 'Student' }}</span>
                            </div>
                            <i class="fas fa-chevron-down text-[10px] text-gray-400 ml-1"></i>
                        </div>

                        <div class="absolute right-0 top-full pt-4 -mt-2 w-48 hidden group-hover:block z-50">
                            <div class="bg-white rounded-xl shadow-xl py-2 border border-gray-100 ring-1 ring-black ring-opacity-5 transform origin-top-right transition-all">
                                <div class="px-4 py-2 border-b border-gray-50 mb-1">
                                    <p class="text-xs text-gray-400">Signed in as</p>
                                    <p class="text-sm font-bold text-gray-900 truncate">{{ Auth::user()->email }}</p>
                                </div>
                                <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-[#B91C1C]">Profile</a>
                                <a href="{{ route('my-products.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-[#B91C1C]">My Products</a>
                                <a href="{{ route('sales.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-[#B91C1C]">Incoming Orders</a>
                                <a href="{{ route('orders.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-[#B91C1C]">My Orders</a>
                                @if(Auth::user()->is_admin)
                                    <div class="border-t border-gray-100 my-1"></div>
                                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-[#B91C1C] font-bold hover:bg-red-50">
                                        <i class="fas fa-shield-alt mr-2"></i> Admin Panel
                                    </a>
                                @endif
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 font-bold hover:bg-red-50">Log Out</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="flex items-center gap-3">
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-[#B91C1C] font-bold text-sm px-3 py-2 transition">
                            Log In
                        </a>
                        <a href="{{ route('signup') }}" class="bg-[#B91C1C] text-white px-5 py-2.5 rounded-full text-sm font-bold hover:bg-red-800 transition shadow-lg shadow-red-900/20 transform hover:-translate-y-0.5">
                            Sign Up
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </div>

    <div class="md:hidden px-4 pb-4 border-t border-gray-100 bg-white">
        <div class="flex space-x-6 py-3 overflow-x-auto no-scrollbar">
            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-[#B91C1C] font-bold' : 'text-gray-500 font-medium whitespace-nowrap' }}">Home</a>
            <a href="{{ route('products') }}" class="{{ request()->routeIs('products') ? 'text-[#B91C1C] font-bold' : 'text-gray-500 font-medium whitespace-nowrap' }}">Products</a>
            <a href="{{ route('about.index') }}" class="{{ request()->routeIs('about.index') ? 'text-[#B91C1C] font-bold' : 'text-gray-500 font-medium whitespace-nowrap' }}">About</a>
        </div>
        <div class="relative">
            <input type="text" placeholder="Search products..." class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-[#B91C1C] focus:ring-1 focus:ring-[#B91C1C]">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-search text-gray-400"></i>
            </div>
        </div>
    </div>
</nav>

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

        if (!searchInput || !searchResults) return;

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
