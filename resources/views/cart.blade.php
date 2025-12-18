<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shopping Cart - TMarket</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 flex flex-col min-h-screen">

    @include('components.navbar')

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 flex-grow w-full">

        <h1 class="text-3xl font-extrabold text-gray-900 mb-8 flex items-center gap-3">
            <span class="bg-red-50 text-[#B91C1C] w-12 h-12 rounded-xl flex items-center justify-center shadow-sm">
                <i class="fas fa-shopping-cart text-xl"></i>
            </span>
            Shopping Cart
        </h1>

        @if(session('success'))
            <div class="mb-6 bg-green-50 border border-green-100 text-green-700 px-4 py-3 rounded-xl flex items-center gap-2 shadow-sm">
                <i class="fas fa-check-circle"></i>
                <span class="font-medium text-sm">{{ session('success') }}</span>
            </div>
        @endif

        @if(session('cart') && count(session('cart')) > 0)

        <div class="flex flex-col lg:flex-row gap-8 items-start">

            <div class="flex-grow w-full space-y-4">

                <form id="checkout-form" action="{{ route('orders.checkout') }}" method="POST">
                    @csrf

                @php $total = 0; @endphp

                @foreach(session('cart') as $id => $details)
                    @php $total += $details['price'] * $details['quantity']; @endphp

                    <div class="bg-white rounded-2xl border border-gray-100 p-4 sm:p-6 shadow-sm flex flex-col sm:flex-row gap-6 items-start relative group transition hover:shadow-md">

                        <div class="flex items-center h-full pt-10 sm:pt-0">
                            <input type="checkbox" name="selected_items[]" value="{{ $id }}" class="w-5 h-5 text-[#B91C1C] border-gray-300 rounded focus:ring-[#B91C1C] item-checkbox" checked onchange="updateTotal()">
                        </div>

                        <div class="w-24 h-24 sm:w-32 sm:h-32 bg-gray-100 rounded-xl overflow-hidden flex-shrink-0 border border-gray-100">
                            <img src="{{ Str::startsWith($details['image'], 'http') ? $details['image'] : asset('storage/' . $details['image']) }}"
                                 alt="{{ $details['name'] }}"
                                 class="w-full h-full object-cover">
                        </div>

                        <div class="flex-grow w-full">
                            <div class="flex justify-between items-start">
                                <div>
                                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">{{ $details['category'] ?? 'Item' }}</span>
                                    <h3 class="font-bold text-gray-900 text-lg leading-tight mb-1">
                                        {{ $details['name'] }}
                                    </h3>
                                    <p class="text-sm text-gray-500 mb-3">Seller: {{ $details['seller'] ?? 'Student' }}</p>
                                </div>

                                <!-- Remove Button (Outside Form) -->
                                <button type="button" onclick="document.getElementById('remove-form-{{ $id }}').submit()" class="text-gray-400 hover:text-red-500 transition p-2 bg-gray-50 rounded-lg hover:bg-red-50" title="Remove Item">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>

                            <div class="flex flex-wrap items-end justify-between gap-4 mt-2">

                                <div>
                                    <div class="text-xl font-extrabold text-[#B91C1C]">
                                        Rp <span class="item-total" data-price="{{ $details['price'] }}" data-quantity="{{ $details['quantity'] }}">{{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}</span>
                                    </div>
                                    @if($details['quantity'] > 1)
                                        <div class="text-xs text-gray-400 font-medium">
                                            {{ $details['quantity'] }} x Rp {{ number_format($details['price'], 0, ',', '.') }}
                                        </div>
                                    @endif
                                </div>

                                <div class="flex items-center border border-gray-200 rounded-xl bg-white shadow-sm overflow-hidden">
                                    <!-- Quantity Update (Outside Form) -->
                                    <button type="button" onclick="updateQuantity('{{ $id }}', {{ $details['quantity'] - 1 }})" class="w-9 h-9 flex items-center justify-center text-gray-500 hover:bg-gray-50 hover:text-[#B91C1C] transition {{ $details['quantity'] <= 1 ? 'opacity-50 cursor-not-allowed' : '' }}" {{ $details['quantity'] <= 1 ? 'disabled' : '' }}>
                                        <i class="fas fa-minus text-xs"></i>
                                    </button>

                                    <div class="w-10 text-center text-sm font-bold text-gray-900 border-x border-gray-100 py-1">
                                        {{ $details['quantity'] }}
                                    </div>

                                    <button type="button" onclick="updateQuantity('{{ $id }}', {{ $details['quantity'] + 1 }})" class="w-9 h-9 flex items-center justify-center text-gray-500 hover:bg-gray-50 hover:text-[#B91C1C] transition">
                                        <i class="fas fa-plus text-xs"></i>
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
                </form>

                <!-- Hidden Forms for Actions -->
                @foreach(session('cart') as $id => $details)
                    <form id="remove-form-{{ $id }}" action="{{ route('cart.remove', $id) }}" method="POST" class="hidden">
                        @csrf @method('DELETE')
                    </form>
                @endforeach

                <form id="update-cart-form" action="{{ route('cart.update') }}" method="POST" class="hidden">
                    @csrf @method('PATCH')
                    <input type="hidden" name="id" id="update-id">
                    <input type="hidden" name="quantity" id="update-quantity">
                </form>

                <div class="mt-6">
                    <a href="{{ route('products') }}" class="inline-flex items-center text-sm font-bold text-gray-500 hover:text-[#B91C1C] transition">
                        <i class="fas fa-arrow-left mr-2"></i> Continue Shopping
                    </a>
                </div>
            </div>

            <div class="w-full lg:w-[380px] flex-shrink-0 lg:sticky lg:top-24">
                <div class="bg-white rounded-3xl border border-gray-100 p-6 shadow-xl shadow-gray-900/5">
                    <h2 class="font-bold text-gray-900 text-lg mb-6 pb-4 border-b border-gray-50">Order Summary</h2>

                    <div class="space-y-4 mb-6">
                        <div class="flex justify-between text-gray-500 text-sm font-medium">
                            <span>Subtotal</span>
                            <span>Rp <span id="summary-subtotal">{{ number_format($total, 0, ',', '.') }}</span></span>
                        </div>
                        <div class="flex justify-between text-gray-500 text-sm font-medium">
                            <span>Platform Fee</span>
                            <span>Rp 0</span>
                        </div>
                        <div class="flex justify-between text-xl font-extrabold text-gray-900 pt-4 border-t border-gray-50">
                            <span>Total</span>
                            <span>Rp <span id="summary-total">{{ number_format($total, 0, ',', '.') }}</span></span>
                        </div>
                    </div>

                    <button type="button" onclick="document.getElementById('checkout-form').submit()" class="w-full bg-[#B91C1C] hover:bg-red-800 text-white font-bold py-4 rounded-xl shadow-lg shadow-red-900/20 transition transform active:scale-[0.98] mb-4 flex items-center justify-center gap-2">
                        Checkout Selected <i class="fas fa-arrow-right"></i>
                    </button>

                    <div class="flex items-center justify-center gap-2 text-xs text-gray-400 font-medium">
                        <i class="fas fa-shield-alt"></i> Secure Transaction
                    </div>
                </div>
            </div>

        </div>

        <script>
            function updateQuantity(id, quantity) {
                document.getElementById('update-id').value = id;
                document.getElementById('update-quantity').value = quantity;
                document.getElementById('update-cart-form').submit();
            }

            function updateTotal() {
                let total = 0;
                const checkboxes = document.querySelectorAll('.item-checkbox:checked');

                checkboxes.forEach(checkbox => {
                    const container = checkbox.closest('.group');
                    const priceElement = container.querySelector('.item-total');
                    const price = parseFloat(priceElement.dataset.price);
                    const quantity = parseInt(priceElement.dataset.quantity);
                    total += price * quantity;
                });

                const formattedTotal = new Intl.NumberFormat('id-ID').format(total);
                document.getElementById('summary-subtotal').textContent = formattedTotal;
                document.getElementById('summary-total').textContent = formattedTotal;
            }
        </script>

        @else
        <div class="flex flex-col items-center justify-center py-24 bg-white rounded-3xl border border-dashed border-gray-200 text-center">
            <div class="w-24 h-24 bg-red-50 rounded-full flex items-center justify-center mb-6 text-[#B91C1C]">
                <i class="fas fa-shopping-basket text-4xl"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-900 mb-2">Your cart is empty</h2>
            <p class="text-gray-500 max-w-sm mb-8 text-sm leading-relaxed">It looks like you haven't discovered our awesome student marketplace yet.</p>
            <a href="{{ route('products') }}" class="px-8 py-3.5 bg-[#B91C1C] text-white rounded-xl font-bold hover:bg-red-800 transition shadow-lg shadow-red-900/20 flex items-center gap-2">
                Start Shopping <i class="fas fa-arrow-right"></i>
            </a>
        </div>
        @endif

    </div>

    @include('components.footer')

</body>
</html>
