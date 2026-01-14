@extends('layouts.admin')

@section('header', 'Dashboard Overview')

@section('content')
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4 hover:-translate-y-1 transition duration-300">
            <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center text-xl flex-shrink-0">
                <i class="fas fa-users"></i>
            </div>
            <div>
                <p class="text-2xl font-extrabold text-gray-900">{{ number_format($newUsers) }}</p>
                <p class="text-xs text-gray-500 font-bold uppercase tracking-wider">New Users (30d)</p>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4 hover:-translate-y-1 transition duration-300">
            <div class="w-12 h-12 bg-green-50 text-green-600 rounded-xl flex items-center justify-center text-xl flex-shrink-0">
                <i class="fas fa-dollar-sign"></i>
            </div>
            <div>
                <p class="text-2xl font-extrabold text-gray-900">Rp{{ number_format($monthlyRevenue, 2) }}</p>
                <p class="text-xs text-gray-500 font-bold uppercase tracking-wider">Revenue (30d)</p>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4 hover:-translate-y-1 transition duration-300">
            <div class="w-12 h-12 bg-yellow-50 text-yellow-600 rounded-xl flex items-center justify-center text-xl flex-shrink-0">
                <i class="fas fa-file-invoice-dollar"></i>
            </div>
            <div>
                <p class="text-2xl font-extrabold text-gray-900">Rp{{ number_format($totalRevenue, 2) }}</p>
                <p class="text-xs text-gray-500 font-bold uppercase tracking-wider">Total Revenue</p>
            </div>
        </div>
        
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4 hover:-translate-y-1 transition duration-300">
            <div class="w-12 h-12 bg-purple-50 text-purple-600 rounded-xl flex items-center justify-center text-xl flex-shrink-0">
                <i class="fas fa-box-open"></i>
            </div>
            <div>
                <p class="text-2xl font-extrabold text-gray-900">{{ number_format($totalProducts) }}</p>
                <p class="text-xs text-gray-500 font-bold uppercase tracking-wider">Total Products</p>
            </div>
        </div>
    </div>
    
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-8 mb-8">
        
        <div class="xl:col-span-2 bg-white rounded-2xl border border-gray-100 shadow-sm p-8">
            <h2 class="text-lg font-bold text-gray-900 mb-6 flex items-center gap-2">
                <i class="fas fa-chart-line text-blue-500"></i> Sales in Last 30 Days
            </h2>
            <canvas id="salesChart" height="150"></canvas>
        </div>

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8">
            <h2 class="text-lg font-bold text-gray-900 mb-6 flex items-center gap-2">
                <i class="fas fa-bolt text-yellow-500"></i> Quick Actions
            </h2>
            
            <div class="flex flex-col gap-4">
                <a href="{{ route('admin.orders.index') }}" class="group flex items-center gap-3 bg-[#B91C1C] hover:bg-red-800 text-white px-6 py-4 rounded-xl font-bold transition shadow-lg shadow-red-900/20">
                    <div class="bg-white/20 rounded-lg p-2 group-hover:bg-white/30 transition text-lg">
                        <i class="fas fa-clipboard-check"></i>
                    </div>
                    <div>
                        <span>Review Pending Orders</span>
                        <span class="text-sm font-normal block opacity-80">{{ $pendingOrders }} orders waiting</span>
                    </div>
                </a>
                <a href="{{ route('admin.products.index') }}" class="group flex items-center gap-3 bg-white border border-gray-200 hover:border-blue-200 hover:bg-blue-50 text-gray-700 hover:text-blue-600 px-6 py-4 rounded-xl font-bold transition">
                    <div class="bg-gray-100 text-gray-500 rounded-lg p-2 group-hover:bg-white group-hover:text-blue-600 transition text-lg">
                        <i class="fas fa-box-open"></i>
                    </div>
                    <span>Manage Products</span>
                </a>
                <a href="{{ route('admin.users.index') }}" class="group flex items-center gap-3 bg-white border border-gray-200 hover:border-blue-200 hover:bg-blue-50 text-gray-700 hover:text-blue-600 px-6 py-4 rounded-xl font-bold transition">
                    <div class="bg-gray-100 text-gray-500 rounded-lg p-2 group-hover:bg-white group-hover:text-blue-600 transition text-lg">
                        <i class="fas fa-users"></i>
                    </div>
                    <span>Manage Users</span>
                </a>
                <a href="{{ route('about.manage') }}" class="group flex items-center gap-3 bg-white border border-gray-200 hover:border-blue-200 hover:bg-blue-50 text-gray-700 hover:text-blue-600 px-6 py-4 rounded-xl font-bold transition">
                    <div class="bg-gray-100 text-gray-500 rounded-lg p-2 group-hover:bg-white group-hover:text-blue-600 transition text-lg">
                        <i class="fas fa-newspaper"></i>
                    </div>
                    <span>Manage About Page</span>
                </a>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($salesChartLabels) !!},
                datasets: [{
                    label: 'Sales',
                    data: {!! json_encode($salesChartData) !!},
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    borderColor: 'rgba(59, 130, 246, 1)',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value, index, values) {
                                return 'Rp' + new Intl.NumberFormat('id-ID').format(value);
                            }
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed.y !== null) {
                                    label += 'Rp' + new Intl.NumberFormat('id-ID').format(context.parsed.y);
                                }
                                return label;
                            }
                        }
                    },
                    legend: {
                        display: false
                    }
                }
            }
        });
    });
</script>
@endpush
