<footer class="bg-white border-t border-gray-200 mt-auto">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <div class="space-y-4">
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <img src="{{ asset('images/logo.png') }}" alt="TMarket Logo" class="h-8 w-auto object-contain">
                    
                    <span class="text-xl font-extrabold text-gray-900 tracking-tight">TMarket<span class="text-[#B91C1C]">.</span></span>
                </a>
                <p class="text-gray-500 text-sm leading-relaxed max-w-xs">
                    The trusted marketplace for Telkom University students. Buy and sell textbooks, electronics, and food safely on campus.
                </p>
            </div>

            <div>
                <h3 class="font-bold text-gray-900 mb-4">Quick Links</h3>
                <ul class="space-y-3 text-sm text-gray-500">
                    <li><a href="{{ route('products') }}" class="hover:text-[#B91C1C] transition">Browse Products</a></li>
                    <li><a href="{{ route('my-products.create') }}" class="hover:text-[#B91C1C] transition">Sell an Item</a></li>
                    <li><a href="{{ route('orders.index') }}" class="hover:text-[#B91C1C] transition">My Orders</a></li>
                    <li><a href="#" class="hover:text-[#B91C1C] transition">Safety Tips</a></li>
                </ul>
            </div>

            <div>
                <h3 class="font-bold text-gray-900 mb-4">Contact Support</h3>
                <ul class="space-y-3 text-sm text-gray-500">
                    <li class="flex items-center gap-2">
                        <i class="far fa-envelope text-[#B91C1C]"></i>
                        <span>support@tmarket.telkomuniversity.ac.id</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fas fa-map-marker-alt text-[#B91C1C]"></i>
                        <span>Telkom University</span>
                    </li>
                </ul>
            </div>
            
        </div>

        <div class="border-t border-gray-100 mt-10 pt-6 flex flex-col md:flex-row justify-between items-center text-xs text-gray-400">
            <p>&copy; {{ date('Y') }} TMarket. All rights reserved.</p>
            <div class="flex gap-4 mt-2 md:mt-0">
                <a href="#" class="hover:text-gray-600">Privacy Policy</a>
                <a href="#" class="hover:text-gray-600">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>