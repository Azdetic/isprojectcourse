<footer class="bg-gray-900 border-t border-gray-800 mt-auto font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <div class="space-y-4">
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <img src="{{ asset('images/logo.png') }}" alt="TMarket Logo" class="h-8 w-auto object-contain bg-white rounded-md p-1">
                    
                    <span class="text-xl font-extrabold text-white tracking-tight">TMarket<span class="text-[#B91C1C]">.</span></span>
                </a>
                <p class="text-gray-400 text-sm leading-relaxed max-w-xs">
                    The trusted marketplace for Telkom University students. Buy and sell textbooks, electronics, and food safely on campus.
                </p>
            </div>

            <div>
                <h3 class="font-bold text-white mb-4">Quick Links</h3>
                <ul class="space-y-3 text-sm text-gray-400">
                    <li><a href="{{ route('products') }}" class="hover:text-white transition">Browse Products</a></li>
                    <li><a href="{{ route('my-products.create') }}" class="hover:text-white transition">Sell an Item</a></li>
                    <li><a href="{{ route('orders.index') }}" class="hover:text-white transition">My Orders</a></li>
                    <li><a href="#" class="hover:text-white transition">Safety Tips</a></li>
                </ul>
            </div>

            <div>
                <h3 class="font-bold text-white mb-4">Contact Support</h3>
                <ul class="space-y-3 text-sm text-gray-400">
                    <li class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-gray-800 flex items-center justify-center text-[#B91C1C] flex-shrink-0">
                            <i class="far fa-envelope"></i>
                        </div>
                        <span>support@tmarket.telkomuniversity.ac.id</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-gray-800 flex items-center justify-center text-[#B91C1C] flex-shrink-0">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <span>Telkom University</span>
                    </li>
                </ul>
            </div>
            
        </div>

        <div class="border-t border-gray-800 mt-12 pt-8 flex flex-col md:flex-row justify-between items-center text-xs text-gray-500">
            <p>&copy; {{ date('Y') }} TMarket. All rights reserved.</p>
            <div class="flex gap-6 mt-4 md:mt-0">
                <a href="#" class="hover:text-gray-300 transition">Privacy Policy</a>
                <a href="#" class="hover:text-gray-300 transition">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>