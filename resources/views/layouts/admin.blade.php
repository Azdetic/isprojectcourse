<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - TMarket</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans">

    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <div class="bg-gray-900 text-white w-64 flex-shrink-0 hidden md:flex flex-col">
            <div class="p-4 border-b border-gray-800 flex items-center gap-2">
                <i class="fas fa-shield-alt text-blue-500 text-xl"></i>
                <span class="font-bold text-lg">Admin Panel</span>
            </div>
            <nav class="flex-1 p-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 rounded hover:bg-gray-800 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-800 text-blue-400' : '' }}">
                    <i class="fas fa-tachometer-alt w-6"></i> Dashboard
                </a>
                <a href="{{ route('admin.orders.index') }}" class="block px-4 py-2 rounded hover:bg-gray-800 {{ request()->routeIs('admin.orders.*') ? 'bg-gray-800 text-blue-400' : '' }}">
                    <i class="fas fa-shopping-cart w-6"></i> Orders
                </a>
                <a href="{{ route('admin.users.index') }}" class="block px-4 py-2 rounded hover:bg-gray-800 {{ request()->routeIs('admin.users.*') ? 'bg-gray-800 text-blue-400' : '' }}">
                    <i class="fas fa-users w-6"></i> Users
                </a>
                <a href="{{ route('admin.products.index') }}" class="block px-4 py-2 rounded hover:bg-gray-800 {{ request()->routeIs('admin.products.*') ? 'bg-gray-800 text-blue-400' : '' }}">
                    <i class="fas fa-box w-6"></i> Products
                </a>
            </nav>
            <div class="p-4 border-t border-gray-800">
                <a href="{{ route('home') }}" class="block px-4 py-2 rounded hover:bg-gray-800 text-gray-400 hover:text-white">
                    <i class="fas fa-arrow-left w-6"></i> Back to Site
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Topbar -->
            <header class="bg-white shadow-sm z-10">
                <div class="flex items-center justify-between px-6 py-4">
                    <h1 class="text-xl font-semibold text-gray-800">@yield('header')</h1>
                    <div class="flex items-center gap-4">
                        <span class="text-sm text-gray-600">Welcome, {{ Auth::user()->name }}</span>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif
                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

</body>
</html>
