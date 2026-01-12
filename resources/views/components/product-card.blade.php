@props(['product'])

<article class="bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 overflow-hidden flex flex-col h-full group">
    <div class="relative h-60 bg-gray-100 overflow-hidden">
        {{-- Accessibility: Descriptive alt text for screen readers --}}
        <a href="{{ route('product-detail', $product->id) }}" aria-label="View details for {{ $product->name }}">
            <img src="{{ Str::startsWith($product->image, 'http') || !Storage::disk('public')->exists($product->image) ? asset($product->image) : Storage::url($product->image) }}"
                 alt="Product image: {{ $product->name }}"
                 class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
        </a>
    </div>

    <div class="p-5 flex flex-col flex-grow">
        <div class="flex items-center gap-2 mb-3">
             <div class="w-5 h-5 rounded-full bg-gray-200 overflow-hidden border border-gray-100">
                 <img src="https://ui-avatars.com/api/?name={{ urlencode($product->seller_name ?? 'User') }}&size=20" alt="Seller: {{ $product->seller_name ?? 'Student' }}">
             </div>
             <span class="text-xs text-gray-600 font-medium truncate">{{ $product->seller_name ?? 'Student Seller' }}</span>
        </div>

        <a href="{{ route('product-detail', $product->id) }}" class="group-hover:text-[#B91C1C] transition-colors">
            <h3 class="font-bold text-gray-900 text-lg mb-1 leading-tight line-clamp-1">{{ $product->name }}</h3>
        </a>

        <div class="text-xl font-extrabold text-[#B91C1C] mb-4">
            Rp {{ number_format($product->price, 0, ',', '.') }}
        </div>

        <div class="mt-auto grid grid-cols-5 gap-3 pt-4 border-t border-gray-100">
            <a href="{{ route('product-detail', $product->id) }}" class="col-span-4 py-2.5 rounded-xl border border-gray-300 text-gray-700 font-bold text-sm hover:border-[#B91C1C] hover:text-[#B91C1C] hover:bg-red-50 transition flex items-center justify-center">
                View Details
            </a>
            @if(Auth::check() && Auth::id() == $product->user_id)
                <button disabled class="col-span-1 py-2.5 rounded-xl bg-gray-200 text-gray-500 font-medium text-sm cursor-not-allowed flex items-center justify-center" aria-label="You own this item">
                    <i class="fas fa-ban" aria-hidden="true"></i>
                </button>
            @else
                <a href="{{ route('cart.add', $product->id) }}" 
                   class="col-span-1 py-2.5 rounded-xl bg-[#B91C1C] text-white font-medium text-sm hover:bg-red-800 transition shadow-lg shadow-red-900/20 flex items-center justify-center"
                   aria-label="Add {{ $product->name }} to cart">
                    <i class="fas fa-cart-plus" aria-hidden="true"></i>
                </a>
            @endif
        </div>
    </div>
</article>
