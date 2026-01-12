<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Buy {{ $product->name }} on TMarket - Telkom University's student marketplace.">
    
    <title>{{ $product->name }} - TMarket</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        button:focus-visible, a:focus-visible {
            outline: 2px solid #B91C1C;
            outline-offset: 2px;
        }
    </style>
</head>
<body class="bg-gray-50 flex flex-col min-h-screen">

    @include('components.navbar')

    <main id="main-content" class="flex-grow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

            {{-- Accessibility: Nav landmark for breadcrumbs --}}
            <nav aria-label="Breadcrumb" class="flex items-center text-sm text-gray-600 mb-8 font-medium">
                <a href="{{ route('home') }}" class="hover:text-[#B91C1C] transition">Home</a>
                <i class="fas fa-chevron-right text-xs mx-3 text-gray-400" aria-hidden="true"></i>
                <a href="{{ route('products') }}" class="hover:text-[#B91C1C] transition">Products</a>
                <i class="fas fa-chevron-right text-xs mx-3 text-gray-400" aria-hidden="true"></i>
                {{-- Contrast Fix: Changed text-gray-500 to gray-900 for better visibility --}}
                <span class="text-gray-900 font-bold truncate" aria-current="page">{{ $product->name }}</span>
            </nav>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-16 mb-16">
                <div class="space-y-4">
                    <div class="bg-white rounded-3xl border border-gray-100 p-2 shadow-sm relative group overflow-hidden">
                        <div class="aspect-square rounded-2xl overflow-hidden bg-gray-100 relative">
                            <img src="{{ Str::startsWith($product->image, 'http') ? $product->image : asset(ltrim($product->image, '/')) }}" 
                                 alt="Main product image for {{ $product->name }}" 
                                 class="w-full h-full object-cover transition duration-500 group-hover:scale-105">
                        </div>
                    </div>
                </div>

                <div class="flex flex-col">
                    <div class="mb-4">
                        <span class="bg-red-50 text-[#B91C1C] text-xs font-bold px-3 py-1.5 rounded-lg uppercase tracking-wider inline-block border border-red-100">
                            {{ $product->category }}
                        </span>
                    </div>

                    <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-3 leading-tight">{{ $product->name }}</h1>

                    <div class="flex items-center gap-2 mb-6">
                        <div class="flex text-yellow-500 text-sm" aria-label="Rating: {{ $product->rating }} out of 5 stars">
                            @for($i = 0; $i < 5; $i++)
                                @if($i < floor($product->rating))
                                    <i class="fas fa-star" aria-hidden="true"></i>
                                @elseif($i < $product->rating)
                                    <i class="fas fa-star-half-alt" aria-hidden="true"></i>
                                @else
                                    <i class="far fa-star text-gray-300" aria-hidden="true"></i>
                                @endif
                            @endfor
                        </div>
                        <span class="text-sm font-bold text-gray-900">{{ $product->rating }}</span>
                        <span class="text-sm text-gray-600 font-medium">({{ $product->reviews_count }} reviews)</span>
                    </div>

                    <div class="text-4xl font-extrabold text-[#B91C1C] mb-8">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </div>

                    @if($product->user_id)
                    <section aria-label="Seller Information" class="bg-white rounded-xl border border-gray-100 p-4 shadow-sm mb-8 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                             <div class="w-12 h-12 rounded-full bg-gray-200 overflow-hidden border border-gray-100">
                                 <img src="https://ui-avatars.com/api/?name={{ urlencode($product->seller_name) }}&background=random&size=48" alt="Seller: {{ $product->seller_name }}">
                             </div>
                             <div>
                                 <div class="text-xs text-gray-600 font-bold uppercase tracking-wider">Sold by</div>
                                 <div class="font-bold text-gray-900">{{ $product->seller_name }}</div>
                             </div>
                        </div>
                        <a href="{{ route('seller.profile', ['id' => $product->user_id]) }}" class="text-sm font-bold text-[#B91C1C] hover:bg-red-50 px-4 py-2 rounded-lg transition" aria-label="View {{ $product->seller_name }} profile">
                            View Profile
                        </a>
                    </section>
                    @endif

                    <div class="grid grid-cols-2 gap-4 mb-8">
                        <div class="bg-gray-50 rounded-xl p-4 border border-gray-100">
                            <div class="flex items-center gap-2 mb-1 text-gray-600">
                                <i class="fas fa-map-marker-alt" aria-hidden="true"></i>
                                <span class="text-xs font-bold uppercase tracking-wider">Location</span>
                            </div>
                            <div class="font-bold text-gray-900 text-sm">{{ $product->user->university ?? 'Telkom University' }}</div>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-4 border border-gray-100">
                             <div class="flex items-center gap-2 mb-1 text-gray-600">
                                <i class="far fa-clock" aria-hidden="true"></i>
                                <span class="text-xs font-bold uppercase tracking-wider">Posted</span>
                            </div>
                            <div class="font-bold text-gray-900 text-sm">{{ $product->created_at->diffForHumans() }}</div>
                        </div>
                    </div>

                    <div class="mb-8">
                        <h2 class="font-bold text-gray-900 mb-2">Description</h2>
                        <p class="text-gray-700 leading-relaxed text-sm md:text-base">
                            {{ $product->description ?? 'No description available for this item.' }}
                        </p>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-4 mt-auto">
                        @if(Auth::check() && Auth::id() == $product->user_id)
                            <button disabled class="flex-1 bg-gray-200 text-gray-600 font-bold py-4 rounded-xl cursor-not-allowed flex items-center justify-center gap-2">
                                <i class="fas fa-ban" aria-hidden="true"></i> You Own This Item
                            </button>
                        @else
                            <a href="{{ route('cart.add', $product->id) }}" class="flex-1 bg-[#B91C1C] hover:bg-red-800 text-white font-bold py-4 rounded-xl shadow-lg shadow-red-900/20 transition transform active:scale-[0.98] flex items-center justify-center gap-2">
                                <i class="fas fa-shopping-cart" aria-hidden="true"></i> Add to Cart
                            </a>
                        @endif
                        @if($product->user_id)
                        <a href="{{ route('chat.show', ['userId' => $product->user_id, 'product_id' => $product->id]) }}" aria-label="Chat with seller {{ $product->seller_name }}" class="flex-1 bg-white border-2 border-gray-300 text-gray-700 hover:border-[#B91C1C] hover:text-[#B91C1C] font-bold py-4 rounded-xl transition flex items-center justify-center gap-2">
                            <i class="far fa-comment-alt" aria-hidden="true"></i> Chat Seller
                        </a>
                        @endif
                    </div>
                </div>
            </div>

            <aside aria-label="Safety Alert" class="bg-blue-50 border border-blue-100 rounded-2xl p-6 mb-16 flex items-start gap-4">
                 <div class="bg-blue-100 text-blue-700 p-2 rounded-lg shrink-0">
                     <i class="fas fa-shield-alt text-xl" aria-hidden="true"></i>
                 </div>
                 <div>
                     <h3 class="font-bold text-blue-900 mb-1">Safety First</h3>
                     <p class="text-sm text-blue-800 leading-relaxed">
                         Always meet in a safe, public location on campus. Check the item thoroughly before making any payment.
                     </p>
                 </div>
            </aside>

            <section aria-labelledby="reviews-title" class="border-t border-gray-100 pt-16">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-10" x-data="{ open: false }">
                    <div>
                        <h2 id="reviews-title" class="text-2xl font-extrabold text-gray-900">Student Reviews</h2>
                        <p class="text-gray-600 text-sm mt-1">See what others are saying about this product.</p>
                    </div>

                    @if($reviewableOrder)
                        <button @click="open = true" class="px-6 py-2.5 bg-white border border-gray-300 text-gray-700 font-bold rounded-xl hover:bg-gray-50 transition shadow-sm text-sm">
                            Write a Review
                        </button>

                        <!-- Review Modal -->
                        <div x-show="open" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4" @click.self="open = false" style="display: none;">
                            <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-8" x-data="{ rating: 0, hoverRating: 0 }">
                                <h3 class="text-xl font-bold text-gray-900 mb-6">Write a review for {{ $product->name }}</h3>
                                <form action="{{ route('reviews.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="order_id" value="{{ $reviewableOrder->id }}">

                                    <div class="mb-4">
                                        <label class="font-bold text-gray-700 block mb-2">Your Rating</label>
                                        <div class="flex items-center space-x-1" @mouseleave="hoverRating = 0">
                                            <template x-for="star in 5" :key="star">
                                                <button type="button" @click="rating = star" @mouseover="hoverRating = star" class="text-2xl" :class="(hoverRating >= star || rating >= star) ? 'text-yellow-500' : 'text-gray-300'">
                                                    <i class="fas fa-star"></i>
                                                </button>
                                            </template>
                                        </div>
                                        <input type="hidden" name="rating" x-model="rating">
                                    </div>

                                    <div class="mb-6">
                                        <label for="comment" class="font-bold text-gray-700 block mb-2">Your Review</label>
                                        <textarea name="comment" id="comment" rows="4" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-red-500 focus:ring-red-500" placeholder="Share your thoughts..."></textarea>
                                    </div>

                                    <div class="mb-8">
                                        <label class="flex items-center">
                                            <input type="checkbox" name="is_anonymous" class="rounded border-gray-300 text-red-600 shadow-sm focus:border-red-300 focus:ring focus:ring-red-200 focus:ring-opacity-50">
                                            <span class="ml-2 text-sm text-gray-600 font-medium">Submit review anonymously</span>
                                        </label>
                                    </div>

                                    <div class="flex justify-end gap-4">
                                        <button type="button" @click="open = false" class="text-sm font-bold text-gray-600 hover:text-gray-900">Cancel</button>
                                        <button type="submit" class="px-6 py-2.5 bg-[#B91C1C] text-white font-bold rounded-xl hover:bg-red-800 transition shadow-sm text-sm">Submit Review</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @else
                        <button disabled class="px-6 py-2.5 bg-gray-100 border border-gray-200 text-gray-400 font-bold rounded-xl transition shadow-sm text-sm cursor-not-allowed" title="You must purchase this item to review it.">
                            Write a Review
                        </button>
                    @endif
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <div class="bg-white rounded-2xl border border-gray-100 p-8 shadow-sm h-fit">
                        <div class="text-center mb-6">
                            <div class="text-6xl font-extrabold text-gray-900 mb-2">{{ number_format($product->rating, 1) }}</div>
                            <div class="flex justify-center text-yellow-500 text-lg mb-2" aria-hidden="true">
                                @for($i = 0; $i < 5; $i++)
                                    <i class="{{ $i < floor($product->rating) ? 'fas' : 'far' }} fa-star"></i>
                                @endfor
                            </div>
                            <div class="text-gray-600 font-bold text-sm uppercase tracking-wide">Based on {{ $product->reviews_count }} Reviews</div>
                        </div>

                        <div class="space-y-4">
                            @foreach ($starPercentages as $star => $percentage)
                            <div class="flex items-center gap-3">
                                <span class="text-sm font-bold text-gray-600">{{ $star }} star</span>
                                <div class="w-full bg-gray-200 rounded-full h-2.5">
                                    <div class="bg-yellow-500 h-2.5 rounded-full" style="width: {{ $percentage }}%"></div>
                                </div>
                                <span class="text-sm font-bold text-gray-700 w-10 text-right">{{ $percentage }}%</span>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="lg:col-span-2 space-y-6">
                        @forelse($reviews as $review)
                        <article class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm">
                            <div class="flex justify-between items-start mb-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-red-50 text-[#B91C1C] flex items-center justify-center font-bold text-sm border border-red-100">
                                        {{ $review['initials'] }}
                                    </div>
                                    <div>
                                        <div class="font-bold text-gray-900 text-sm">{{ $review['user'] }}</div>
                                        <div class="text-xs text-gray-600 font-medium">{{ $review['time'] }}</div>
                                    </div>
                                </div>
                            </div>
                            <p class="text-gray-700 text-sm mb-4">{{ $review['comment'] }}</p>
                            <button class="flex items-center text-gray-600 text-xs font-bold hover:text-red-600 transition gap-1.5" 
                                    aria-label="Mark this review by {{ $review['user'] }} as helpful">
                                <i class="far fa-thumbs-up" aria-hidden="true"></i> Helpful ({{ $review['helpful'] }})
                            </button>
                        </article>
                        @empty
                        <div class="bg-white border border-gray-100 rounded-2xl p-8 text-center shadow-sm">
                            <h3 class="text-lg font-bold text-gray-900">No Reviews Yet</h3>
                            <p class="text-sm text-gray-600 mt-1">Be the first to share your experience!</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </section>

        </div>
    </main>

    @include('components.footer')

</body>
</html>