<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Orders - TMarket</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .active-tab {
            color: #B91C1C;
            border-bottom: 2px solid #B91C1C;
            background-color: #FEF2F2;
        }
        .inactive-tab {
            color: #6B7280;
            border-bottom: 2px solid transparent;
        }
        .inactive-tab:hover {
            color: #B91C1C;
            background-color: #FAFAFA;
        }
    </style>
</head>
<body class="bg-gray-50 flex flex-col min-h-screen">

    @include('components.navbar')

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 flex-grow w-full">

        <div class="mb-8">
            <h1 class="text-3xl font-extrabold text-gray-900">My Orders</h1>
            <p class="text-gray-500 font-medium">Track your purchases and view history.</p>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 mb-8 overflow-hidden">
            <div class="flex overflow-x-auto no-scrollbar">
                <a href="{{ route('orders.index', ['status' => 'to_pay']) }}" class="flex-1 py-4 px-6 text-center text-sm font-bold whitespace-nowrap transition {{ $status == 'to_pay' ? 'active-tab' : 'inactive-tab' }}">
                    <i class="far fa-credit-card mr-2"></i> To Pay
                </a>
                <a href="{{ route('orders.index', ['status' => 'pending_approval']) }}" class="flex-1 py-4 px-6 text-center text-sm font-bold whitespace-nowrap transition {{ $status == 'pending_approval' ? 'active-tab' : 'inactive-tab' }}">
                    <i class="fas fa-clock mr-2"></i> Pending Approval
                </a>
                <a href="{{ route('orders.index', ['status' => 'to_ship']) }}" class="flex-1 py-4 px-6 text-center text-sm font-bold whitespace-nowrap transition {{ $status == 'to_ship' ? 'active-tab' : 'inactive-tab' }}">
                    <i class="fas fa-box mr-2"></i> To Ship
                </a>
                <a href="{{ route('orders.index', ['status' => 'to_receive']) }}" class="flex-1 py-4 px-6 text-center text-sm font-bold whitespace-nowrap transition {{ $status == 'to_receive' ? 'active-tab' : 'inactive-tab' }}">
                    <i class="fas fa-truck mr-2"></i> To Receive
                </a>
                <a href="{{ route('orders.index', ['status' => 'completed']) }}" class="flex-1 py-4 px-6 text-center text-sm font-bold whitespace-nowrap transition {{ $status == 'completed' ? 'active-tab' : 'inactive-tab' }}">
                    <i class="fas fa-check-circle mr-2"></i> Completed
                </a>
            </div>
        </div>

        <div class="space-y-6">
            @forelse($orders as $order)
                <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6 sm:p-8 transition hover:shadow-md">

                    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center border-b border-gray-100 pb-4 mb-6 gap-2">
                        <div class="text-sm text-gray-500 font-medium">
                            <span class="font-bold text-gray-900">Order #{{ $order->id }}</span>
                            <span class="mx-2">•</span>
                            {{ $order->created_at->format('d M Y, H:i') }}
                        </div>
                        <div class="self-start sm:self-auto">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide
                                {{ $order->status == 'completed' ? 'bg-green-50 text-green-600 border border-green-100' : 'bg-red-50 text-[#B91C1C] border border-red-100' }}">
                                {{ str_replace('_', ' ', $order->status) }}
                            </span>
                        </div>
                    </div>

                    <div class="space-y-6 mb-6">
                        @foreach($order->items as $item)
                            <div class="flex items-start gap-4 sm:gap-6">
                                <a href="{{ route('product-detail', $item->product_id) }}" class="w-20 h-20 sm:w-24 sm:h-24 bg-gray-100 rounded-xl overflow-hidden border border-gray-100 flex-shrink-0 group block">
                                    <img src="{{ Str::startsWith($item->product_image, 'http') ? $item->product_image : asset($item->product_image) }}"
                                         alt="{{ $item->product_name }}"
                                         class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                </a>
                                <div class="flex-1 min-w-0">
                                    <a href="{{ route('product-detail', $item->product_id) }}" class="group">
                                        <h3 class="text-base font-bold text-gray-900 leading-tight mb-1 group-hover:text-[#B91C1C] transition">{{ $item->product_name }}</h3>
                                    </a>
                                    <p class="text-sm text-gray-500 mb-2">Quantity: {{ $item->quantity }}</p>
                                    <div class="text-sm font-bold text-[#B91C1C]">
                                        Rp {{ number_format($item->price, 0, ',', '.') }}
                                    </div>
                                </div>
                            </div>

                            @if($order->status == 'completed')
                                @php
                                    // Logic to check if user already reviewed this item in this order
                                    $hasReviewed = $order->reviews->where('product_id', $item->product_id)->isNotEmpty();
                                @endphp

                                <div class="flex justify-end mt-[-10px]">
                                    @if($hasReviewed)
                                        <span class="text-xs font-bold text-green-600 bg-green-50 px-3 py-1.5 rounded-lg border border-green-100">
                                            <i class="fas fa-check mr-1"></i> Reviewed
                                        </span>
                                    @else
                                        <button onclick="openReviewModal({{ $item->product_id }}, {{ $order->id }}, '{{ addslashes($item->product_name) }}')"
                                                class="text-xs font-bold bg-white border border-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:border-[#B91C1C] hover:text-[#B91C1C] transition shadow-sm">
                                            <i class="far fa-star mr-1"></i> Write Review
                                        </button>
                                    @endif
                                </div>
                                @if(!$loop->last) <hr class="border-gray-50 my-4"> @endif
                            @endif
                        @endforeach
                    </div>

                    <div class="flex flex-col sm:flex-row justify-between items-center pt-6 border-t border-gray-100 gap-4">
                        <div class="flex items-center gap-2">
                            <span class="text-sm text-gray-500 font-medium">Total Order:</span>
                            <span class="text-xl font-extrabold text-[#B91C1C]">
                                Rp {{ number_format($order->total_price, 0, ',', '.') }}
                            </span>
                        </div>

                        <div class="w-full sm:w-auto">
                            @if($order->status == 'to_pay')
                                <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <button class="w-full sm:w-auto bg-[#B91C1C] text-white px-6 py-3 rounded-xl text-sm font-bold hover:bg-red-800 transition shadow-lg shadow-red-900/20">
                                        Pay Now
                                    </button>
                                </form>
                            @elseif($order->status == 'pending_approval')
                                <button disabled class="w-full sm:w-auto bg-yellow-100 text-yellow-700 px-6 py-3 rounded-xl text-sm font-bold cursor-not-allowed">
                                    Waiting for Approval
                                </button>
                            @elseif($order->status == 'to_ship')
                                <button disabled class="w-full sm:w-auto bg-gray-100 text-gray-400 px-6 py-3 rounded-xl text-sm font-bold cursor-not-allowed">
                                    Waiting for Shipment
                                </button>
                            @elseif($order->status == 'to_receive')
                                <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <button class="w-full sm:w-auto bg-green-600 text-white px-6 py-3 rounded-xl text-sm font-bold hover:bg-green-700 transition shadow-lg shadow-green-900/20">
                                        Order Received
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-20">
                    <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6 text-gray-300">
                        <i class="fas fa-box-open text-4xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-1">No orders found</h3>
                    <p class="text-gray-500 text-sm">You don't have any orders in this status yet.</p>
                </div>
            @endforelse
        </div>
    </div>

    <div id="reviewModal" class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm hidden items-center justify-center z-50 transition-opacity">
        <div class="bg-white rounded-3xl p-8 w-full max-w-md mx-4 shadow-2xl transform transition-all scale-100">
            <div class="flex justify-between items-start mb-6">
                <div>
                    <h3 class="text-xl font-bold text-gray-900">Write Review</h3>
                    <p class="text-xs text-gray-500 mt-1" id="review_product_name_display"></p>
                </div>
                <button onclick="closeReviewModal()" class="w-8 h-8 rounded-full bg-gray-100 text-gray-400 hover:bg-gray-200 hover:text-gray-600 flex items-center justify-center transition">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <form action="{{ route('reviews.store') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" id="review_product_id">
                <input type="hidden" name="order_id" id="review_order_id">

                <div class="mb-6 text-center">
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">Rate this product</label>
                    <div class="flex justify-center gap-3 text-3xl cursor-pointer" id="starContainer">
                        <i class="fas fa-star text-gray-200 hover:text-yellow-400 transition transform hover:scale-110" onclick="setRating(1)"></i>
                        <i class="fas fa-star text-gray-200 hover:text-yellow-400 transition transform hover:scale-110" onclick="setRating(2)"></i>
                        <i class="fas fa-star text-gray-200 hover:text-yellow-400 transition transform hover:scale-110" onclick="setRating(3)"></i>
                        <i class="fas fa-star text-gray-200 hover:text-yellow-400 transition transform hover:scale-110" onclick="setRating(4)"></i>
                        <i class="fas fa-star text-gray-200 hover:text-yellow-400 transition transform hover:scale-110" onclick="setRating(5)"></i>
                    </div>
                    <input type="hidden" name="rating" id="ratingInput" required>
                </div>

                <div class="mb-6">
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Your Experience</label>
                    <textarea name="comment" rows="3" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-gray-900 font-medium focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#B91C1C]/20 focus:border-[#B91C1C] transition resize-none" placeholder="How was the quality? Did you like it?"></textarea>
                </div>

                <div class="mb-6 flex items-center p-3 bg-gray-50 rounded-xl border border-gray-100">
                    <input type="checkbox" name="is_anonymous" id="is_anonymous" class="w-4 h-4 text-[#B91C1C] border-gray-300 rounded focus:ring-[#B91C1C]">
                    <label for="is_anonymous" class="ml-3 block text-sm font-bold text-gray-700 cursor-pointer select-none">
                        Hide my name (Anonymous)
                    </label>
                </div>

                <button type="submit" class="w-full bg-[#B91C1C] text-white font-bold py-3.5 rounded-xl hover:bg-red-800 transition shadow-lg shadow-red-900/20 active:scale-[0.98]">
                    Submit Review
                </button>
            </form>
        </div>
    </div>

    <script>
        function openReviewModal(productId, orderId, productName) {
            const modal = document.getElementById('reviewModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');

            document.getElementById('review_product_id').value = productId;
            document.getElementById('review_order_id').value = orderId;
            document.getElementById('review_product_name_display').textContent = productName;
        }

        function closeReviewModal() {
            const modal = document.getElementById('reviewModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        function setRating(rating) {
            document.getElementById('ratingInput').value = rating;
            const stars = document.getElementById('starContainer').children;
            for (let i = 0; i < 5; i++) {
                if (i < rating) {
                    stars[i].classList.add('text-yellow-400');
                    stars[i].classList.remove('text-gray-200');
                } else {
                    stars[i].classList.remove('text-yellow-400');
                    stars[i].classList.add('text-gray-200');
                }
            }
        }
    </script>

    @include('components.footer')

</body>
</html>
