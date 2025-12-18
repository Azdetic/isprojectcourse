@extends('layouts.admin')

@section('header', 'Manage Products')

@section('content')
    
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-100">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Product</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Seller</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Price</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Category</th>
                        <th class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse($products as $product)
                    <tr class="hover:bg-gray-50 transition duration-150">
                        
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="h-12 w-12 flex-shrink-0 bg-gray-100 rounded-lg overflow-hidden border border-gray-200">
                                    <img class="h-full w-full object-cover" 
                                         src="{{ $product->image ? asset($product->image) : 'https://via.placeholder.com/150' }}" 
                                         alt="{{ $product->name }}">
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-bold text-gray-900">{{ $product->name }}</div>
                                    <div class="text-xs text-gray-400">ID: #{{ $product->id }}</div>
                                </div>
                            </div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="h-8 w-8 flex-shrink-0">
                                    <img class="h-8 w-8 rounded-full border border-gray-200" 
                                         src="https://ui-avatars.com/api/?name={{ urlencode($product->seller->name ?? 'Unknown') }}&background=random&color=fff&bold=true" 
                                         alt="">
                                </div>
                                <div class="ml-3">
                                    <div class="text-sm font-medium text-gray-900">{{ $product->seller->name ?? 'Unknown' }}</div>
                                    <div class="text-xs text-gray-500">{{ $product->seller->email ?? '' }}</div>
                                </div>
                            </div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-[#B91C1C]">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-gray-100 text-gray-600 border border-gray-200">
                                {{ $product->category }}
                            </span>
                        </td>
                        
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this product? This action cannot be undone.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-50 hover:bg-red-100 text-red-600 p-2 rounded-lg transition duration-200 group" title="Delete Product">
                                    <i class="fas fa-trash-alt group-hover:scale-110 transition-transform"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center text-gray-400">
                                <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-3">
                                    <i class="fas fa-box-open text-2xl text-gray-300"></i>
                                </div>
                                <span class="text-sm font-medium text-gray-500">No products found in the catalog.</span>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if(method_exists($products, 'links'))
            <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
                {{ $products->links() }}
            </div>
        @endif
    </div>
@endsection