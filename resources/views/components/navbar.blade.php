<nav class="bg-white shadow-sm sticky top-0 z-50 border-b border-gray-100 font-sans" aria-label="Main Navigation">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20 items-center">

            <div class="flex items-center gap-8">
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center gap-3" aria-label="TMarket Home">
                        <img src="{{ asset('images/logo.png') }}" alt="TMarket Logo" class="h-10 w-auto object-contain" width="40" height="40">
                        <span class="text-2xl font-extrabold text-[#B91C1C] tracking-tight uppercase">TMARKET</span>
                    </a>
                </div>

                <div class="hidden md:flex space-x-6">
                    <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-[#B91C1C] font-bold' : 'text-gray-600 hover:text-[#B91C1C] font-medium transition' }}">Home</a>
                    <a href="{{ route('products') }}" class="{{ request()->routeIs('products') ? 'text-[#B91C1C] font-bold' : 'text-gray-600 hover:text-[#B91C1C] font-medium transition' }}">Products</a>
                    <a href="{{ route('about.index') }}" class="{{ request()->routeIs('about.index') ? 'text-[#B91C1C] font-bold' : 'text-gray-600 hover:text-[#B91C1C] font-medium transition' }}">About</a>
                </div>
            </div>

            <div class="flex-1 max-w-lg mx-8 hidden md:block">
                <form action="{{ route('products') }}" method="GET" class="relative group" role="search">
                    <label for="search-input" class="sr-only">Search products</label>
                    <input type="text" name="search" id="search-input" placeholder="Search for books, electronics..."
                        class="w-full pl-11 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-full focus:outline-none focus:border-[#B91C1C] focus:ring-1 focus:ring-[#B91C1C] text-sm transition-all group-hover:bg-white group-hover:shadow-sm"
                        value="{{ request('search') }}">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400 group-hover:text-[#B91C1C] transition" aria-hidden="true"></i>
                    </div>

                    <div id="search-results" class="absolute top-full left-0 right-0 mt-2 bg-white border border-gray-200 rounded-lg shadow-lg z-50 hidden max-h-96 overflow-y-auto" aria-live="polite">
                        <div id="search-results-content"></div>
                    </div>
                </form>
            </div>

            <div class="flex items-center space-x-5">
                <a href="{{ route('orders.index') }}" 
                   class="text-gray-600 hover:text-[#B91C1C] relative transition p-2 rounded-full hover:bg-red-50" 
                   aria-label="View my orders">
                    <i class="fas fa-clipboard-list text-lg" aria-hidden="true"></i>
                </a>
                <a href="{{ route('cart.index') }}" 
                   class="text-gray-600 hover:text-[#B91C1C] relative transition p-2 rounded-full hover:bg-red-50" 
                   aria-label="View shopping cart">
                    <i class="fas fa-shopping-cart text-lg" aria-hidden="true"></i>
                </a>

                @auth
                    <div class="relative ml-2 group z-50">
                        <button type="button" aria-haspopup="true" aria-expanded="false" class="flex items-center space-x-2 cursor-pointer py-2" aria-label="User Menu">
                            <img class="h-9 w-9 rounded-full object-cover border-2 border-white shadow-sm"
                                 src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=B91C1C&color=fff&bold=true"
                                 alt="Profile: {{ Auth::user()->name }}">
                            <div class="hidden sm:flex flex-col items-start leading-tight">
                                <span class="text-sm font-bold text-gray-800">{{ Auth::user()->name }}</span>
                                <span class="text-[10px] text-gray-600">{{ Auth::user()->is_admin ? 'Admin' : 'Student' }}</span>
                            </div>
                            <i class="fas fa-chevron-down text-[10px] text-gray-400 ml-1" aria-hidden="true"></i>
                        </button>

                        <div class="absolute right-0 top-full pt-4 -mt-2 w-48 hidden group-hover:block z-50">
                            <div class="bg-white rounded-xl shadow-xl py-2 border border-gray-100 ring-1 ring-black ring-opacity-5">
                                <div class="px-4 py-2 border-b border-gray-50 mb-1">
                                    <p class="text-xs text-gray-500">Signed in as</p>
                                    <p class="text-sm font-bold text-gray-900 truncate">{{ Auth::user()->email }}</p>
                                </div>
                                <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-[#B91C1C]">Profile</a>
                                <a href="{{ route('my-products.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-[#B91C1C]">My Products</a>
                                <a href="{{ route('sales.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-[#B91C1C]">Incoming Orders</a>
                                <a href="{{ route('orders.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-[#B91C1C]">View my orders</a>
                                @if(Auth::user()->is_admin)
                                    <div class="border-t border-gray-100 my-1"></div>
                                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-[#B91C1C] font-bold hover:bg-red-50">
                                        <i class="fas fa-shield-alt mr-2" aria-hidden="true"></i> Admin Panel
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
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-[#B91C1C] font-bold text-sm px-3 py-2 transition">Log In</a>
                        <a href="{{ route('signup') }}" class="bg-[#B91C1C] text-white px-5 py-2.5 rounded-full text-sm font-bold hover:bg-red-800 transition shadow-lg shadow-red-900/20 transform hover:-translate-y-0.5">Sign Up</a>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</nav>