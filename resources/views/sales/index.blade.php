<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Incoming Orders - TMarket</title>

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
        <div class="mb-8">
            <h2 class="text-3xl font-extrabold text-gray-900">Incoming Orders (My Sales)</h2>
            <p class="text-gray-500 font-medium">Manage orders for your products.</p>
        </div>

        @if($groupedSales->isEmpty())
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100 p-10 text-center">
                <div class="mb-4">
                    <i class="fas fa-box-open text-gray-300 text-6xl"></i>
                </div>
                <p class="text-gray-500 text-lg">You haven't sold any items yet.</p>
            </div>
        @else
            <div class="space-y-6">
                @foreach($groupedSales as $orderId => $items)
                    @php $order = $items->first()->order; @endphp
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100">
                        <!-- Order Header -->
                        <div class="bg-gray-50 px-6 py-4 border-b border-gray-100 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                            <div>
                                <div class="flex items-center gap-3">
                                    <span class="text-lg font-bold text-gray-900">Order #{{ $orderId }}</span>
                                    <span class="px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if($order->status == 'completed') bg-green-100 text-green-800
                                        @elseif($order->status == 'to_ship') bg-yellow-100 text-yellow-800
                                        @elseif($order->status == 'to_receive') bg-blue-100 text-blue-800
                                        @else bg-gray-100 text-gray-800 @endif">
                                        {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                                    </span>
                                </div>
                                <div class="text-sm text-gray-500 mt-1">
                                    Buyer: <span class="font-medium text-gray-700">{{ $order->user->name }}</span> &bull;
                                    {{ $order->created_at->format('d M Y, H:i') }}
                                </div>
                            </div>

                            @if($order->status == 'to_ship')
                                <form action="{{ route('sales.ship', $items->first()->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-bold transition shadow-sm flex items-center gap-2">
                                        <i class="fas fa-shipping-fast"></i> Ship Order
                                    </button>
                                </form>
                            @endif
                        </div>

                        <!-- Order Items -->
                        <div class="divide-y divide-gray-100">
                            @foreach($items as $item)
                                <div class="p-6 flex items-center gap-6">
                                    <!-- Image -->
                                    <div class="h-20 w-20 flex-shrink-0 rounded-lg border border-gray-200 overflow-hidden bg-gray-50">
                                        @if(Str::startsWith($item->product->image, 'http'))
                                            <img src="{{ $item->product->image }}" alt="{{ $item->product->name }}" class="h-full w-full object-cover">
                                        @else
                                            <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="h-full w-full object-cover">
                                        @endif
                                    </div>

                                    <!-- Details -->
                                    <div class="flex-1">
                                        <h3 class="text-base font-bold text-gray-900">{{ $item->product->name }}</h3>
                                        <p class="text-sm text-gray-500 mt-1">Quantity: {{ $item->quantity }}</p>
                                    </div>

                                    <!-- Price -->
                                    <div class="text-right">
                                        <p class="text-sm text-gray-500">Total Earned</p>
                                        <p class="text-lg font-bold text-[#B91C1C]">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Footer Summary -->
                        <div class="bg-gray-50 px-6 py-3 border-t border-gray-100 text-right">
                            <span class="text-sm text-gray-600">Total for your items:</span>
                            <span class="text-base font-bold text-gray-900 ml-2">
                                Rp {{ number_format($items->sum(fn($i) => $i->price * $i->quantity), 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
