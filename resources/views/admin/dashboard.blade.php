@extends('layouts.admin')

@section('header', 'Dashboard Overview')

@section('content')
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4 hover:-translate-y-1 transition duration-300">
            <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center text-xl flex-shrink-0">
                <i class="fas fa-users"></i>
            </div>
            <div>
                <p class="text-2xl font-extrabold text-gray-900">{{ $totalUsers }}</p>
                <p class="text-xs text-gray-500 font-bold uppercase tracking-wider">Total Users</p>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4 hover:-translate-y-1 transition duration-300">
            <div class="w-12 h-12 bg-green-50 text-green-600 rounded-xl flex items-center justify-center text-xl flex-shrink-0">
                <i class="fas fa-shopping-bag"></i>
            </div>
            <div>
                <p class="text-2xl font-extrabold text-gray-900">{{ $totalOrders }}</p>
                <p class="text-xs text-gray-500 font-bold uppercase tracking-wider">Total Orders</p>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4 hover:-translate-y-1 transition duration-300">
            <div class="w-12 h-12 bg-yellow-50 text-yellow-600 rounded-xl flex items-center justify-center text-xl flex-shrink-0">
                <i class="fas fa-clock"></i>
            </div>
            <div>
                <p class="text-2xl font-extrabold text-gray-900">{{ $pendingOrders }}</p>
                <p class="text-xs text-gray-500 font-bold uppercase tracking-wider">Pending Approval</p>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4 hover:-translate-y-1 transition duration-300">
            <div class="w-12 h-12 bg-purple-50 text-purple-600 rounded-xl flex items-center justify-center text-xl flex-shrink-0">
                <i class="fas fa-box-open"></i>
            </div>
            <div>
                <p class="text-2xl font-extrabold text-gray-900">{{ $totalProducts }}</p>
                <p class="text-xs text-gray-500 font-bold uppercase tracking-wider">Active Products</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8">
        <h2 class="text-lg font-bold text-gray-900 mb-6 flex items-center gap-2">
            <i class="fas fa-bolt text-yellow-500"></i> Quick Actions
        </h2>
        
        <div class="flex flex-wrap gap-4">
            <a href="{{ route('admin.orders.index') }}" class="group flex items-center gap-3 bg-[#B91C1C] hover:bg-red-800 text-white px-6 py-3 rounded-xl font-bold transition shadow-lg shadow-red-900/20">
                <div class="bg-white/20 rounded-lg p-1.5 group-hover:bg-white/30 transition">
                    <i class="fas fa-clipboard-check"></i>
                </div>
                <span>Review Pending Orders</span>
            </a>

            <a href="{{ route('about.manage') }}" class="group flex items-center gap-3 bg-white border border-gray-200 hover:border-red-200 hover:bg-red-50 text-gray-700 hover:text-[#B91C1C] px-6 py-3 rounded-xl font-bold transition">
                <div class="bg-gray-100 text-gray-500 rounded-lg p-1.5 group-hover:bg-white group-hover:text-[#B91C1C] transition">
                    <i class="fas fa-newspaper"></i>
                </div>
                <span>Manage About Page</span>
            </a>
        </div>
    </div>
@endsection