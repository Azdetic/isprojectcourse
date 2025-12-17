<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders - TMarket</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
        .active-tab { border-bottom: 2px solid #B91C1C; color: #B91C1C; font-weight: 600; }
        .inactive-tab { color: #6B7280; }
        .inactive-tab:hover { color: #374151; }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">

    @include('components.navbar')

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 w-full flex-grow">
        <h1 class="text-2xl font-bold text-gray-900 mb-6">My Orders</h1>

        <!-- Tabs -->
        <div class="bg-white shadow rounded-lg mb-6">
            <div class="flex border-b border-gray-200 overflow-x-auto">
                <a href="{{ route('orders.index', ['status' => 'to_pay']) }}" class="flex-1 py-4 px-6 text-center text-sm whitespace-nowrap {{ $status == 'to_pay' ? 'active-tab' : 'inactive-tab' }}">
                    To Pay
                </a>
                <a href="{{ route('orders.index', ['status' => 'to_ship']) }}" class="flex-1 py-4 px-6 text-center text-sm whitespace-nowrap {{ $status == 'to_ship' ? 'active-tab' : 'inactive-tab' }}">
                    To Ship
                </a>
                <a href="{{ route('orders.index', ['status' => 'to_receive']) }}" class="flex-1 py-4 px-6 text-center text-sm whitespace-nowrap {{ $status == 'to_receive' ? 'active-tab' : 'inactive-tab' }}">
                    To Receive
                </a>
                <a href="{{ route('orders.index', ['status' => 'completed']) }}" class="flex-1 py-4 px-6 text-center text-sm whitespace-nowrap {{ $status == 'completed' ? 'active-tab' : 'inactive-tab' }}">
                    Completed
                </a>
            </div>
        </div>

        <!-- Orders List -->
        <div class="space-y-4">
            @forelse($orders as $order)
                <div class="bg-white shadow rounded-lg p-6">
                    <div class="flex justify-between items-center border-b border-gray-100 pb-4 mb-4">
                        <div class="text-sm text-gray-500">
                            Order #{{ $order->id }} • {{ $order->created_at->format('d M Y H:i') }}
                        </div>
                        <div class="text-sm font-bold uppercase tracking-wide
                            {{ $order->status == 'completed' ? 'text-green-600' : 'text-[#B91C1C]' }}">
                            {{ str_replace('_', ' ', $order->status) }}
                        </div>
                    </div>

                    <div class="space-y-4 mb-4">
                        @foreach($order->items as $item)
                            <div class="flex items-start gap-4">
                                <img src="{{ $item->product_image }}" alt="{{ $item->product_name }}" class="w-16 h-16 object-cover rounded-md border border-gray-200">
                                <div class="flex-1">
                                    <h3 class="text-sm font-medium text-gray-900">{{ $item->product_name }}</h3>
                                    <p class="text-sm text-gray-500">x{{ $item->quantity }}</p>
                                </div>
                                <div class="text-sm font-medium text-gray-900">
                                    Rp {{ number_format($item->price, 0, ',', '.') }}
                                </div>
                            </div>

                            @if($order->status == 'completed')
                                @php
                                    $hasReviewed = $order->reviews->where('product_id', $item->product_id)->isNotEmpty();
                                @endphp

                                <div class="flex justify-end mt-2">
                                    @if($hasReviewed)
                                        <span class="text-xs text-green-600 font-medium px-3 py-1.5">
                                            <i class="fas fa-check"></i> Reviewed
                                        </span>
                                    @else
                                        <button onclick="openReviewModal({{ $item->product_id }}, {{ $order->id }}, '{{ addslashes($item->product_name) }}')" class="text-xs bg-gray-100 hover:bg-gray-200 text-gray-700 px-3 py-1.5 rounded transition">
                                            Write a Review
                                        </button>
                                    @endif
                                </div>
                            @endif
                        @endforeach
                    </div>

                    <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                        <div class="text-sm text-gray-500">
                            Total Order
                        </div>
                        <div class="text-lg font-bold text-[#B91C1C]">
                            Rp {{ number_format($order->total_price, 0, ',', '.') }}
                        </div>
                    </div>

                    <!-- Action Buttons for Demo -->
                    <div class="mt-4 flex justify-end">
                        @if($order->status == 'to_pay')
                            <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST">
                                @csrf @method('PATCH')
                                <button class="bg-[#B91C1C] text-white px-4 py-2 rounded-lg text-sm font-bold hover:bg-red-800 transition">
                                    Pay Now
                                </button>
                            </form>
                        @elseif($order->status == 'to_ship')
                            <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST">
                                @csrf @method('PATCH')
                                <button class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-bold hover:bg-blue-700 transition">
                                    Ship Order (Demo)
                                </button>
                            </form>
                        @elseif($order->status == 'to_receive')
                            <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST">
                                @csrf @method('PATCH')
                                <button class="bg-green-600 text-white px-4 py-2 rounded-lg text-sm font-bold hover:bg-green-700 transition">
                                    Order Received
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @empty
                <div class="text-center py-12">
                    <div class="bg-gray-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-box-open text-2xl text-gray-400"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900">No orders found</h3>
                    <p class="text-gray-500">You don't have any orders in this status.</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Review Modal -->
    <div id="reviewModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-xl p-6 w-full max-w-md mx-4">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-bold text-gray-900">Write Review</h3>
                <button onclick="closeReviewModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <form action="{{ route('reviews.store') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" id="review_product_id">
                <input type="hidden" name="order_id" id="review_order_id">

                <p id="review_product_name" class="text-sm text-gray-600 mb-4 font-medium"></p>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Rating</label>
                    <div class="flex gap-2 text-2xl text-gray-300 cursor-pointer" id="starContainer">
                        <i class="fas fa-star hover:text-yellow-400 transition" onclick="setRating(1)"></i>
                        <i class="fas fa-star hover:text-yellow-400 transition" onclick="setRating(2)"></i>
                        <i class="fas fa-star hover:text-yellow-400 transition" onclick="setRating(3)"></i>
                        <i class="fas fa-star hover:text-yellow-400 transition" onclick="setRating(4)"></i>
                        <i class="fas fa-star hover:text-yellow-400 transition" onclick="setRating(5)"></i>
                    </div>
                    <input type="hidden" name="rating" id="ratingInput" required>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Comment</label>
                    <textarea name="comment" rows="3" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-red-500 focus:ring-red-500" placeholder="How was the product?"></textarea>
                </div>

                <div class="mb-4 flex items-center">
                    <input type="checkbox" name="is_anonymous" id="is_anonymous" class="rounded border-gray-300 text-red-600 shadow-sm focus:border-red-300 focus:ring focus:ring-red-200 focus:ring-opacity-50">
                    <label for="is_anonymous" class="ml-2 block text-sm text-gray-900">
                        Review anonymously (Hide my name)
                    </label>
                </div>

                <button type="submit" class="w-full bg-[#B91C1C] text-white font-bold py-2 rounded-lg hover:bg-red-800 transition">
                    Submit Review
                </button>
            </form>
        </div>
    </div>

    <script>
        function openReviewModal(productId, orderId, productName) {
            document.getElementById('reviewModal').classList.remove('hidden');
            document.getElementById('reviewModal').classList.add('flex');
            document.getElementById('review_product_id').value = productId;
            document.getElementById('review_order_id').value = orderId;
            document.getElementById('review_product_name').textContent = productName;
        }

        function closeReviewModal() {
            document.getElementById('reviewModal').classList.add('hidden');
            document.getElementById('reviewModal').classList.remove('flex');
        }

        function setRating(rating) {
            document.getElementById('ratingInput').value = rating;
            const stars = document.getElementById('starContainer').children;
            for (let i = 0; i < 5; i++) {
                if (i < rating) {
                    stars[i].classList.add('text-yellow-400');
                    stars[i].classList.remove('text-gray-300');
                } else {
                    stars[i].classList.remove('text-yellow-400');
                    stars[i].classList.add('text-gray-300');
                }
            }
        }
    </script>

    @include('components.footer')

</body>
</html>
