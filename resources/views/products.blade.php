<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Browse Products - TMarket</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-gray-50 flex flex-col min-h-screen">

    @include('components.navbar')

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 flex-grow w-full">

        <div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight mb-2">Browse Products</h1>
                <p class="text-gray-500 font-medium">Discover unique items from your fellow Telkom University students.</p>
            </div>
        </div>

        <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 mb-8">
            <div class="flex flex-col md:flex-row md:items-center justify-between space-y-4 md:space-y-0">
                <div class="flex items-center overflow-x-auto no-scrollbar pb-1 md:pb-0 gap-2">
                    <span class="text-gray-400 font-bold text-xs uppercase tracking-wider mr-2 whitespace-nowrap">Filter:</span>
                    <a href="{{ route('products') }}" class="bg-[#B91C1C] text-white px-5 py-2 rounded-full text-sm font-bold whitespace-nowrap shadow-md shadow-red-900/20 transition hover:bg-red-800">
                        All Items
                    </a>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse($products as $product)
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 overflow-hidden flex flex-col h-full group">

                <div class="relative h-60 bg-gray-100 overflow-hidden">
                    <a href="{{ route('product-detail', $product->id) }}" class="block w-full h-full">
                        <img src="{{ Str::startsWith($product->image, 'http') ? $product->image : asset(ltrim($product->image, '/')) }}" 
                             alt="{{ $product->name }}" 
                             class="w-full h-full object-cover group-hover:scale-110 transition duration-700"
                             onerror="this.src='https://placehold.co/400x400?text=No+Image'">
                    </a>

                    <div class="absolute top-3 left-3 bg-white/90 backdrop-blur-md px-3 py-1 rounded-lg border border-gray-100 shadow-sm pointer-events-none">
                        <span class="text-[10px] font-bold text-gray-500 uppercase tracking-wide">{{ $product->category }}</span>
                    </div>
                </div>

                <div class="p-5 flex flex-col flex-grow">
                    <div class="flex items-center gap-2 mb-3">
                         <div class="w-5 h-5 rounded-full bg-gray-200 overflow-hidden border border-gray-100 flex-shrink-0">
                             <img src="https://ui-avatars.com/api/?name={{ urlencode($product->seller_name ?? $product->user->name ?? 'User') }}&background=random&size=20" alt="Seller">
                         </div>
                         <span class="text-xs text-gray-500 font-medium truncate">{{ $product->seller_name ?? $product->user->name ?? 'Student Seller' }}</span>
                    </div>

                    <a href="{{ route('product-detail', $product->id) }}" class="group-hover:text-[#B91C1C] transition-colors">
                        <h3 class="font-bold text-gray-900 text-lg mb-1 leading-tight line-clamp-1">{{ $product->name }}</h3>
                    </a>

                    <div class="text-xl font-extrabold text-[#B91C1C] mb-4">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </div>

                    <div class="mt-auto grid grid-cols-5 gap-3 pt-4 border-t border-gray-50">
                        <a href="{{ route('product-detail', $product->id) }}" class="col-span-4 py-2.5 rounded-xl border border-gray-200 text-gray-700 font-bold text-sm hover:border-[#B91C1C] hover:text-[#B91C1C] hover:bg-red-50 transition flex items-center justify-center">
                            View Details
                        </a>
                        <a href="{{ route('cart.add', $product->id) }}" class="col-span-1 py-2.5 rounded-xl bg-[#B91C1C] text-white font-medium text-sm hover:bg-red-800 transition shadow-lg shadow-red-900/20 flex items-center justify-center">
                            <i class="fas fa-cart-plus"></i>
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full py-12 text-center">
                <div class="bg-gray-50 border border-dashed border-gray-200 rounded-2xl p-10 flex flex-col items-center justify-center">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4 text-gray-300">
                        <i class="fas fa-search text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900">No products found</h3>
                    <p class="text-gray-500 text-sm mt-1 max-w-xs mx-auto">Try listing a product first!</p>
                </div>
            </div>
            @endforelse
        </div>
        
        @if(method_exists($products, 'links'))
        <div class="mt-8">
            {{ $products->links() }}
        </div>
        @endif

    </div>

    @include('components.footer')

</body>
</html>