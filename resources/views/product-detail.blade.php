<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TMarket - {{ $product['name'] }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
        }
        .t-red { color: #D12026; }
        .bg-t-red { background-color: #D12026; }
        .border-t-red { border-color: #D12026; }
        .btn-outline-red {
            border: 1px solid #D12026;
            color: #D12026;
        }
        .btn-outline-red:hover {
            background-color: #D12026;
            color: white;
        }
    </style>
</head>
<body class="bg-white">

    <!-- Navbar -->
    @include('components.navbar')

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('products') }}" class="text-gray-600 hover:text-red-600 font-medium flex items-center transition">
                <i class="fas fa-arrow-left mr-2"></i> Back to Products
            </a>
        </div>

        <!-- Main Product Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-16">
            <!-- Left Column: Image -->
            <div class="bg-gray-100 rounded-2xl overflow-hidden aspect-square flex items-center justify-center">
                <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" class="w-full h-full object-cover">
            </div>

            <!-- Right Column: Product Info -->
            <div>
                <!-- Category Badge -->
                <span class="bg-t-red text-white text-xs font-bold px-3 py-1 rounded-full inline-block mb-4">{{ $product['category'] }}</span>

                <!-- Title -->
                <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $product['name'] }}</h1>

                <!-- Price -->
                <div class="text-3xl font-bold t-red mb-4">Rp {{ number_format($product['price'], 0, ',', '.') }}</div>

                <!-- Rating -->
                <div class="flex items-center mb-6 pb-6 border-b border-gray-100">
                    <div class="flex text-t-red text-sm mr-2">
                        @for($i = 0; $i < 5; $i++)
                            @if($i < floor($product['rating'] ?? 0))
                                <i class="fas fa-star"></i>
                            @elseif($i < ($product['rating'] ?? 0))
                                <i class="fas fa-star-half-alt"></i>
                            @else
                                <i class="far fa-star"></i>
                            @endif
                        @endfor
                    </div>
                    <span class="text-gray-500 text-sm font-medium">{{ $product['rating'] ?? 0 }} ({{ $product['reviews_count'] ?? 0 }} reviews)</span>
                </div>

                <!-- Meta Info -->
                <div class="space-y-3 mb-6 pb-6 border-b border-gray-100">
                    <div class="flex items-center text-gray-600">
                        <i class="far fa-user w-6 text-center mr-3 text-gray-400"></i>
                        <div>
                            <div class="text-xs text-gray-400">Seller</div>
                            <div class="font-medium text-sm">{{ $product['seller'] }}</div>
                        </div>
                    </div>
                    <div class="flex items-center text-gray-600">
                        <i class="fas fa-map-marker-alt w-6 text-center mr-3 text-gray-400"></i>
                        <div>
                            <div class="text-xs text-gray-400">Location</div>
                            <div class="font-medium text-sm">{{ $product['location'] ?? 'Telkom University Campus' }}</div>
                        </div>
                    </div>
                    <div class="flex items-center text-gray-600">
                        <i class="far fa-clock w-6 text-center mr-3 text-gray-400"></i>
                        <div>
                            <div class="text-xs text-gray-400">Posted</div>
                            <div class="font-medium text-sm">{{ $product['posted'] ?? 'Recently' }}</div>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="mb-8">
                    <h3 class="font-bold text-gray-900 mb-2">Description</h3>
                    <p class="text-gray-600 leading-relaxed">
                        {{ $product['description'] ?? 'No description available.' }}
                    </p>
                </div>

                <!-- Action Buttons -->
                <div class="grid grid-cols-2 gap-4 mb-8">
                    <button class="bg-t-red hover:bg-red-700 text-white font-medium py-3 rounded-lg transition flex items-center justify-center">
                        <i class="fas fa-shopping-cart mr-2"></i> Add to Cart
                    </button>
                    <button class="bg-white border border-gray-300 text-gray-700 hover:border-red-500 hover:text-red-500 font-medium py-3 rounded-lg transition">
                        Contact Seller
                    </button>
                </div>

                <!-- Safety Tips -->
                <div class="bg-blue-50 rounded-xl p-5">
                    <h3 class="font-bold text-gray-900 mb-3 text-sm">Safety Tips</h3>
                    <ul class="text-sm text-gray-600 space-y-2 list-disc list-inside">
                        <li>Meet in a public place on campus</li>
                        <li>Check the item condition before paying</li>
                        <li>Report suspicious listings</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Student Reviews Section -->
        <div class="mb-16">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-2xl font-bold text-gray-900">Student Reviews</h2>
                <button class="btn-outline-red px-6 py-2 rounded-lg text-sm font-medium transition">Write a Review</button>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Review Summary -->
                <div class="bg-gray-50 rounded-xl p-6 h-fit">
                    <div class="flex items-end mb-4">
                        <span class="text-5xl font-bold text-gray-900 mr-2">{{ $product['rating'] ?? 0 }}</span>
                        <div class="mb-2">
                            <div class="flex text-t-red text-sm mb-1">
                                @for($i = 0; $i < 5; $i++)
                                    @if($i < floor($product['rating'] ?? 0))
                                        <i class="fas fa-star"></i>
                                    @elseif($i < ($product['rating'] ?? 0))
                                        <i class="fas fa-star-half-alt"></i>
                                    @else
                                        <i class="far fa-star"></i>
                                    @endif
                                @endfor
                            </div>
                            <span class="text-gray-500 text-sm">{{ $product['reviews_count'] ?? 0 }} reviews</span>
                        </div>
                    </div>

                    @php
                        $ratingCounts = [5 => 0, 4 => 0, 3 => 0, 2 => 0, 1 => 0];
                        $totalReviews = isset($product['reviews']) ? count($product['reviews']) : 0;
                        if($totalReviews > 0) {
                            foreach($product['reviews'] as $review) {
                                if(isset($ratingCounts[$review['rating']])) {
                                    $ratingCounts[$review['rating']]++;
                                }
                            }
                        }
                    @endphp

                    <div class="space-y-2">
                        @for($star = 5; $star >= 1; $star--)
                            @php
                                $count = $ratingCounts[$star];
                                $percentage = $totalReviews > 0 ? ($count / $totalReviews) * 100 : 0;
                            @endphp
                            <div class="flex items-center text-sm">
                                <span class="w-12 text-gray-600">{{ $star }} star</span>
                                <div class="flex-1 h-2 bg-gray-200 rounded-full mx-3 overflow-hidden">
                                    <div class="h-full bg-t-red" style="width: {{ $percentage }}%"></div>
                                </div>
                                <span class="w-6 text-right text-gray-500">{{ $count }}</span>
                            </div>
                        @endfor
                    </div>
                </div>

                <!-- Review List -->
                <div class="lg:col-span-2 space-y-6">
                    @if(isset($product['reviews']) && count($product['reviews']) > 0)
                        @foreach($product['reviews'] as $review)
                        <div class="bg-white border border-gray-100 rounded-xl p-6 shadow-sm">
                            <div class="flex justify-between items-start mb-4">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 rounded-full bg-red-100 text-t-red flex items-center justify-center font-bold text-sm mr-3">{{ $review['initials'] }}</div>
                                    <div>
                                        <div class="font-semibold text-gray-900 text-sm">{{ $review['user'] }}</div>
                                        <div class="text-xs text-gray-500">{{ $review['time'] }}</div>
                                    </div>
                                </div>
                                <div class="flex text-t-red text-xs">
                                    @for($i = 0; $i < 5; $i++)
                                        @if($i < $review['rating'])
                                            <i class="fas fa-star"></i>
                                        @else
                                            <i class="far fa-star"></i>
                                        @endif
                                    @endfor
                                </div>
                            </div>
                            <p class="text-gray-600 text-sm mb-4">{{ $review['comment'] }}</p>
                            <button class="flex items-center text-gray-500 text-xs font-medium hover:text-gray-700 transition">
                                <i class="far fa-thumbs-up mr-1.5"></i> Helpful ({{ $review['helpful'] }})
                            </button>
                        </div>
                        @endforeach
                    @else
                        <div class="bg-white border border-gray-100 rounded-xl p-6 shadow-sm text-center">
                            <p class="text-gray-500">No reviews yet.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- More from this category -->
        <div class="mb-12">
            <h2 class="text-xl font-bold text-gray-900 mb-6">More from this category</h2>
            <div class="bg-gray-50 rounded-xl h-48 flex items-center justify-center border border-dashed border-gray-300">
                <span class="text-gray-400 font-medium">Similar products will appear here</span>
            </div>
        </div>

    </div>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-100 py-8 mt-12">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p class="text-gray-500 text-sm mb-1">&copy; 2025 TMarket – Telkom University Student Marketplace</p>
            <p class="text-gray-400 text-xs">Made by Students, for Students.</p>
        </div>
    </footer>

</body>
</html>
