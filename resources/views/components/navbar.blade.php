    <!-- Navbar -->
    <nav class="bg-white shadow-sm sticky top-0 z-50 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <!-- Left Side: Logo & Menu -->
                <div class="flex items-center">
                    <!-- Logo -->
                    <div class="flex-shrink-0 flex items-center mr-8">
                        <a href="{{ route('home') }}" class="flex items-center gap-2">
                            <i class="fas fa-shopping-bag t-red text-2xl"></i>
                            <span class="text-2xl font-bold t-red tracking-tight">TMARKET</span>
                        </a>
                    </div>

                    <!-- Desktop Menu -->
                    <div class="hidden md:flex space-x-8">
                        <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 't-red font-medium' : 'text-gray-500 hover:text-red-600 font-medium transition' }}">Home</a>
                        <a href="{{ route('products') }}" class="{{ request()->routeIs('products') ? 't-red font-medium' : 'text-gray-500 hover:text-red-600 font-medium transition' }}">Products</a>
                        <a href="#" class="text-gray-500 hover:text-red-600 font-medium transition">About</a>
                    </div>
                </div>

                <!-- Center: Search Bar -->
                <div class="flex-1 max-w-xl mx-8 hidden md:block">
                    <div class="relative">
                        <input type="text" placeholder="Search products..." class="w-full pl-10 pr-4 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 text-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                    </div>
                </div>

                <!-- Right Side: Icons & Auth -->
                <div class="flex items-center space-x-6">
                    <a href="#" class="text-gray-600 hover:text-red-600 relative">
                        <i class="fas fa-shopping-cart text-lg"></i>
                    </a>

                    @auth
                        <!-- User Profile -->
                        <div class="relative ml-2 group">
                            <div class="flex items-center space-x-2 cursor-pointer">
                                <img class="h-8 w-8 rounded-full object-cover border border-gray-200" src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=D12026&color=fff" alt="{{ Auth::user()->name }}">
                                <span class="text-sm font-medium text-gray-700 hidden sm:block">{{ Auth::user()->name }}</span>
                                <i class="fas fa-chevron-down text-xs text-gray-500"></i>
                            </div>
                            <!-- Dropdown for Logout -->
                            <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 hidden group-hover:block border border-gray-100">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Logout</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <div class="flex items-center space-x-3">
                            <a href="{{ route('login') }}" class="btn-outline-red px-5 py-1.5 rounded-md text-sm font-medium transition">Login</a>
                            <a href="{{ route('signup') }}" class="bg-t-red text-white px-5 py-1.5 rounded-md text-sm font-medium hover:bg-red-700 transition shadow-sm">Sign Up</a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>

        <!-- Mobile Search & Menu (Visible on small screens) -->
        <div class="md:hidden px-4 pb-3 border-t border-gray-100 pt-3">
            <div class="flex space-x-4 mb-3 overflow-x-auto no-scrollbar">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 't-red font-medium whitespace-nowrap' : 'text-gray-500 font-medium whitespace-nowrap' }}">Home</a>
                <a href="{{ route('products') }}" class="{{ request()->routeIs('products') ? 't-red font-medium whitespace-nowrap' : 'text-gray-500 font-medium whitespace-nowrap' }}">Products</a>
                <a href="#" class="text-gray-500 font-medium whitespace-nowrap">About</a>
            </div>
            <div class="relative">
                <input type="text" placeholder="Search products..." class="w-full pl-10 pr-4 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
            </div>
        </div>
    </nav>
