<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Shop - TMarket</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style> body { font-family: 'Plus Jakarta Sans', sans-serif; } </style>
</head>
<body class="bg-gray-50 flex flex-col min-h-screen">

    @include('components.navbar')

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 flex-grow w-full">

        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 mb-1">My Shop</h1>
                <p class="text-gray-500 text-sm">Manage the items you are selling on campus.</p>
            </div>
            <a href="{{ route('my-products.create') }}" class="px-6 py-3 bg-[#B91C1C] text-white rounded-xl font-bold hover:bg-red-800 transition shadow-lg shadow-red-900/20 flex items-center gap-2">
                <i class="fas fa-plus"></i> Sell New Item
            </a>
        </div>

        @if(session('success'))
            <div class="mb-6 bg-green-50 border border-green-100 text-green-700 px-4 py-3 rounded-xl flex items-center gap-2 shadow-sm">
                <i class="fas fa-check-circle"></i>
                <span class="font-medium text-sm">{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-100 text-xs uppercase tracking-wider text-gray-500 font-bold">
                            <th class="px-6 py-4">Product</th>
                            <th class="px-6 py-4">Price</th>
                            <th class="px-6 py-4">Category</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($products as $product)
                        <tr class="hover:bg-gray-50/50 transition">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-gray-100 rounded-lg overflow-hidden border border-gray-100 flex-shrink-0">
                                        <img src="{{ asset($product->image) }}" class="w-full h-full object-cover"> 
                                             alt="{{ $product->name }}"
                                             class="w-full h-full object-cover">
                                    </div>
                                    <div>
                                        <div class="font-bold text-gray-900 line-clamp-1">{{ $product->name }}</div>
                                        <div class="text-xs text-gray-400 line-clamp-1">{{ $product->description }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 font-bold text-[#B91C1C]">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="bg-gray-100 text-gray-600 px-2.5 py-1 rounded-lg text-xs font-bold border border-gray-200">
                                    {{ $product->category }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-green-50 text-green-600 border border-green-100">
                                    <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Active
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('my-products.edit', $product->id) }}" class="p-2 text-gray-400 hover:text-[#B91C1C] hover:bg-red-50 rounded-lg transition" title="Edit">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    
                                    <form action="{{ route('my-products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition" title="Delete">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-16 text-center text-gray-500">
                                <div class="flex flex-col items-center">
                                    <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-4 text-gray-300">
                                        <i class="far fa-folder-open text-2xl"></i>
                                    </div>
                                    <h3 class="text-lg font-bold text-gray-900">No items listed</h3>
                                    <p class="text-sm mb-6">You haven't listed any items for sale yet.</p>
                                    <a href="{{ route('my-products.create') }}" class="text-[#B91C1C] font-bold hover:underline text-sm">
                                        Sell your first item
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if(method_exists($products, 'links'))
                <div class="px-6 py-4 border-t border-gray-100">
                    {{ $products->links() }}
                </div>
            @endif
        </div>

    </div>

    @include('components.footer')

</body>
</html>