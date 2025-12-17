<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $product['name'] }} - TMarket</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 flex flex-col min-h-screen">

    @include('components.navbar')

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 flex-grow">

        <nav class="flex items-center text-sm text-gray-500 mb-8 font-medium">
            <a href="{{ route('home') }}" class="hover:text-[#B91C1C] transition">Home</a>
            <i class="fas fa-chevron-right text-xs mx-3 text-gray-400"></i>
            <a href="{{ route('products') }}" class="hover:text-[#B91C1C] transition">Products</a>
            <i class="fas fa-chevron-right text-xs mx-3 text-gray-400"></i>
            <span class="text-gray-900 font-bold truncate">{{ $product['name'] }}</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-16 mb-16">
            
            <div class="space-y-4">
                <div class="bg-white rounded-3xl border border-gray-100 p-2 shadow-sm relative group overflow-hidden">
                    <div class="aspect-square rounded-2xl overflow-hidden bg-gray-100 relative">
                        <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" class="w-full h-full object-cover transition duration-500 group-hover:scale-105">
                    </div>
                    <button class="absolute top-6 right-6 bg-white/90 backdrop-blur-md p-3 rounded-full text-gray-400 hover:text-red-500 hover:bg-red-50 transition shadow-sm border border-gray-100">
                        <i class="far fa-heart text-xl"></i>
                    </button>
                </div>
            </div>

            <div class="flex flex-col">
                <div class="mb-4">
                    <span class="bg-red-50 text-[#B91C1C] text-xs font-bold px-3 py-1.5 rounded-lg uppercase tracking-wider inline-block border border-red-100">
                        {{ $product['category'] }}
                    </span>
                </div>

                <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-3 leading-tight">{{ $product['name'] }}</h1>

                <div class="flex items-center gap-2 mb-6">
                    <div class="flex text-yellow-400 text-sm">
                        @for($i = 0; $i < 5; $i++)
                            @if($i < floor($product['rating'] ?? 0))
                                <i class="fas fa-star"></i>
                            @elseif($i < ($product['rating'] ?? 0))
                                <i class="fas fa-star-half-alt"></i>
                            @else
                                <i class="far fa-star text-gray-200"></i>
                            @endif
                        @endfor
                    </div>
                    <span class="text-sm font-bold text-gray-900">{{ $product['rating'] ?? 0 }}</span>
                    <span class="text-sm text-gray-400 font-medium">({{ $product['reviews_count'] ?? 0 }} reviews)</span>
                </div>

                <div class="text-4xl font-extrabold text-[#B91C1C] mb-8">
                    Rp {{ number_format($product['price'], 0, ',', '.') }}
                </div>

                <div class="bg-white rounded-xl border border-gray-100 p-4 shadow-sm mb-8 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                         <div class="w-12 h-12 rounded-full bg-gray-200 overflow-hidden border border-gray-100">
                             <img src="https://ui-avatars.com/api/?name={{ urlencode($product['seller']) }}&background=random&size=48" alt="Seller">
                         </div>
                         <div>
                             <div class="text-xs text-gray-400 font-bold uppercase tracking-wider">Sold by</div>
                             <div class="font-bold text-gray-900">{{ $product['seller'] }}</div>
                         </div>
                    </div>
                    <button class="text-sm font-bold text-[#B91C1C] hover:bg-red-50 px-4 py-2 rounded-lg transition">
                        View Profile
                    </button>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-8">
                    <div class="bg-gray-50 rounded-xl p-4 border border-gray-100">
                        <div class="flex items-center gap-2 mb-1 text-gray-400">
                            <i class="fas fa-map-marker-alt"></i>
                            <span class="text-xs font-bold uppercase tracking-wider">Location</span>
                        </div>
                        <div class="font-bold text-gray-900 text-sm">{{ $product['location'] ?? 'Telkom University' }}</div>
                    </div>
                    <div class="bg-gray-50 rounded-xl p-4 border border-gray-100">
                         <div class="flex items-center gap-2 mb-1 text-gray-400">
                            <i class="far fa-clock"></i>
                            <span class="text-xs font-bold uppercase tracking-wider">Posted</span>
                        </div>
                        <div class="font-bold text-gray-900 text-sm">{{ $product['posted'] ?? '2 days ago' }}</div>
                    </div>
                </div>

                <div class="mb-8">
                    <h3 class="font-bold text-gray-900 mb-2">Description</h3>
                    <p class="text-gray-600 leading-relaxed text-sm md:text-base">
                        {{ $product['description'] ?? 'No description available for this item. Please contact the seller for more details.' }}
                    </p>
                </div>

                <div class="flex flex-col sm:flex-row gap-4 mt-auto">
                    <button class="flex-1 bg-[#B91C1C] hover:bg-red-800 text-white font-bold py-4 rounded-xl shadow-lg shadow-red-900/20 transition transform active:scale-[0.98] flex items-center justify-center gap-2">
                        <i class="fas fa-shopping-cart"></i> Add to Cart
                    </button>
                    <button class="flex-1 bg-white border-2 border-gray-200 text-gray-700 hover:border-[#B91C1C] hover:text-[#B91C1C] font-bold py-4 rounded-xl transition flex items-center justify-center gap-2">
                        <i class="far fa-comment-alt"></i> Chat Seller
                    </button>
                </div>

            </div>
        </div>
        
        <div class="bg-blue-50 border border-blue-100 rounded-2xl p-6 mb-16 flex items-start gap-4">
             <div class="bg-blue-100 text-blue-600 p-2 rounded-lg shrink-0">
                 <i class="fas fa-shield-alt text-xl"></i>
             </div>
             <div>
                 <h3 class="font-bold text-blue-900 mb-1">Safety First</h3>
                 <p class="text-sm text-blue-700/80 leading-relaxed">
                     Always meet in a safe, public location on campus (like the library or canteen). Check the item thoroughly before making any payment. Report suspicious activity to TMarket support.
                 </p>
             </div>
        </div>

        <div class="border-t border-gray-100 pt-16">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-10">
                <div>
                    <h2 class="text-2xl font-extrabold text-gray-900">Student Reviews</h2>
                    <p class="text-gray-500 text-sm mt-1">See what others are saying about this seller.</p>
                </div>
                <button class="px-6 py-2.5 bg-white border border-gray-200 text-gray-700 font-bold rounded-xl hover:bg-gray-50 transition shadow-sm text-sm">
                    Write a Review
                </button>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="bg-white rounded-2xl border border-gray-100 p-8 shadow-sm h-fit">
                    <div class="text-center mb-6">
                        <div class="text-6xl font-extrabold text-gray-900 mb-2">{{ $product['rating'] ?? 4.8 }}</div>
                        <div class="flex justify-center text-yellow-400 text-lg mb-2">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                        </div>
                        <div class="text-gray-400 font-bold text-sm uppercase tracking-wide">Based on {{ $product['reviews_count'] ?? 12 }} Reviews</div>
                    </div>
                    <div class="space-y-3">
                         @for($i = 5; $i >= 1; $i--)
                        <div class="flex items-center gap-3 text-xs font-bold text-gray-500">
                            <span class="w-3">{{ $i }}</span>
                            <div class="flex-1 h-2 bg-gray-100 rounded-full overflow-hidden">
                                <div class="h-full bg-[#B91C1C]" style="width: {{ $i == 5 ? '70%' : ($i == 4 ? '20%' : '5%') }}"></div>
                            </div>
                        </div>
                        @endfor
                    </div>
                </div>

                <div class="lg:col-span-2 space-y-6">
                    @if(isset($product['reviews']) && count($product['reviews']) > 0)
                        @foreach($product['reviews'] as $review)
                        <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm hover:shadow-md transition">
                            <div class="flex justify-between items-start mb-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-red-50 text-[#B91C1C] flex items-center justify-center font-bold text-sm border border-red-100">
                                        {{ $review['initials'] ?? 'ST' }}
                                    </div>
                                    <div>
                                        <div class="font-bold text-gray-900 text-sm">{{ $review['user'] ?? 'Student' }}</div>
                                        <div class="text-xs text-gray-400 font-medium">{{ $review['time'] ?? '1 week ago' }}</div>
                                    </div>
                                </div>
                                <div class="flex text-yellow-400 text-xs">
                                     @for($i = 0; $i < 5; $i++)
                                        <i class="{{ $i < ($review['rating'] ?? 5) ? 'fas' : 'far' }} fa-star"></i>
                                    @endfor
                                </div>
                            </div>
                            <p class="text-gray-600 text-sm leading-relaxed mb-4">{{ $review['comment'] ?? 'Great item, exactly as described!' }}</p>
                            <button class="flex items-center text-gray-400 text-xs font-bold hover:text-gray-600 transition gap-1.5">
                                <i class="far fa-thumbs-up"></i> Helpful ({{ $review['helpful'] ?? 0 }})
                            </button>
                        </div>
                        @endforeach
                    @else
                        <div class="text-center py-12 bg-gray-50 rounded-2xl border border-dashed border-gray-200">
                            <i class="far fa-comment-dots text-4xl text-gray-300 mb-3"></i>
                            <p class="text-gray-500 font-medium">No reviews yet. Be the first to review!</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

    </div>

    @include('components.footer')

</body>
</html>