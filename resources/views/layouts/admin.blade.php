<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel - TMarket</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style> 
        body { font-family: 'Plus Jakarta Sans', sans-serif; } 
        /* Hide scrollbar for Chrome, Safari and Opera */
        .no-scrollbar::-webkit-scrollbar { display: none; }
        /* Hide scrollbar for IE, Edge and Firefox */
        .no-scrollbar { -ms-overflow-style: none;  scrollbar-width: none; }
    </style>
</head>
<body class="bg-gray-50 font-sans text-gray-900">

    <div class="flex h-screen overflow-hidden">
        
        <aside class="w-64 bg-white border-r border-gray-200 hidden md:flex flex-col z-20">
            
            <div class="h-20 flex items-center px-8 border-b border-gray-100">
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-8 w-auto object-contain">
                    <span class="text-xl font-extrabold text-[#B91C1C] tracking-tight uppercase">ADMIN</span>
                </a>
            </div>

            <nav class="flex-1 p-4 space-y-2 overflow-y-auto no-scrollbar">
                
                <p class="px-4 text-xs font-bold text-gray-400 uppercase tracking-wider mb-2 mt-2">Menu</p>

                <a href="{{ route('admin.dashboard') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-xl font-bold transition {{ request()->routeIs('admin.dashboard') ? 'bg-red-50 text-[#B91C1C]' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-900' }}">
                    <i class="fas fa-th-large w-5"></i> Dashboard
                </a>

                <a href="{{ route('admin.orders.index') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-xl font-bold transition {{ request()->routeIs('admin.orders.*') ? 'bg-red-50 text-[#B91C1C]' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-900' }}">
                    <i class="fas fa-shopping-bag w-5"></i> Orders
                </a>

                <a href="{{ route('admin.users.index') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-xl font-bold transition {{ request()->routeIs('admin.users.*') ? 'bg-red-50 text-[#B91C1C]' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-900' }}">
                    <i class="fas fa-users w-5"></i> Users
                </a>

                <a href="{{ route('admin.products.index') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-xl font-bold transition {{ request()->routeIs('admin.products.*') ? 'bg-red-50 text-[#B91C1C]' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-900' }}">
                    <i class="fas fa-box w-5"></i> Products
                </a>

                <p class="px-4 text-xs font-bold text-gray-400 uppercase tracking-wider mb-2 mt-6">Content</p>

                <a href="{{ route('about.manage') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-xl font-bold transition {{ request()->routeIs('about.*') ? 'bg-red-50 text-[#B91C1C]' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-900' }}">
                    <i class="fas fa-newspaper w-5"></i> About Page
                </a>

            </nav>

            <div class="p-4 border-t border-gray-100">
                <a href="{{ route('home') }}" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:text-[#B91C1C] hover:bg-red-50 rounded-xl font-medium transition mb-1">
                    <i class="fas fa-arrow-left w-5"></i> Back to Site
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center gap-3 px-4 py-3 text-red-600 hover:bg-red-50 rounded-xl w-full font-bold transition">
                        <i class="fas fa-sign-out-alt w-5"></i> Log Out
                    </button>
                </form>
            </div>
        </aside>

        <div class="flex-1 flex flex-col overflow-hidden relative">
            
            <header class="bg-white shadow-sm border-b border-gray-100 z-10 h-20 flex-shrink-0">
                <div class="flex items-center justify-between px-8 h-full">
                    
                    <h1 class="text-xl font-extrabold text-gray-900">@yield('header', 'Dashboard')</h1>
                    
                    <div class="flex items-center gap-4">
                        <div class="text-right hidden sm:block">
                            <span class="block text-sm font-bold text-gray-900">{{ Auth::user()->name }}</span>
                            <span class="block text-xs text-gray-500 font-medium">Administrator</span>
                        </div>
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=B91C1C&color=fff&bold=true" 
                             alt="{{ Auth::user()->name }}"
                             class="h-10 w-10 rounded-full border-2 border-white shadow-sm object-cover">
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-6 md:p-8">
                
                @if(session('success'))
                    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-6 flex items-center gap-3 shadow-sm" role="alert">
                        <i class="fas fa-check-circle"></i>
                        <span class="font-bold text-sm">{{ session('success') }}</span>
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-6 flex items-center gap-3 shadow-sm" role="alert">
                        <i class="fas fa-exclamation-circle"></i>
                        <span class="font-bold text-sm">{{ session('error') }}</span>
                    </div>
                @endif

                @yield('content')
                
            </main>
        </div>
    </div>

</body>
</html>