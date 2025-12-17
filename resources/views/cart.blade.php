<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart - TMarket</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
        }
        .t-red { color: #B91C1C; }
        .bg-t-red { background-color: #B91C1C; }
        .hover-bg-t-red:hover { background-color: #991B1B; }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">

    @include('components.navbar')

    <div class="flex-grow flex items-center justify-center">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 w-full">

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if(session('cart') && count(session('cart')) > 0)
                <div class="bg-white shadow rounded-lg overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @php $total = 0 @endphp
                                @foreach(session('cart') as $id => $details)
                                    @php $total += $details['price'] * $details['quantity'] @endphp
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <img class="h-10 w-10 rounded-full object-cover" src="{{ $details['image'] }}" alt="{{ $details['name'] }}">
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">{{ $details['name'] }}</div>
                                                    <div class="text-sm text-gray-500">{{ $details['seller'] }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">Rp {{ number_format($details['price'], 0, ',', '.') }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center border border-gray-300 rounded-lg w-fit">
                                                <form action="{{ route('cart.update') }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="id" value="{{ $id }}">
                                                    <input type="hidden" name="quantity" value="{{ $details['quantity'] - 1 }}">
                                                    <button type="submit" class="px-3 py-1 text-gray-600 hover:bg-gray-100 hover:text-red-600 transition disabled:opacity-50" {{ $details['quantity'] <= 1 ? 'disabled' : '' }}>
                                                        <i class="fas fa-minus text-xs"></i>
                                                    </button>
                                                </form>

                                                <span class="px-2 text-sm font-medium text-gray-900 w-8 text-center">{{ $details['quantity'] }}</span>

                                                <form action="{{ route('cart.update') }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="id" value="{{ $id }}">
                                                    <input type="hidden" name="quantity" value="{{ $details['quantity'] + 1 }}">
                                                    <button type="submit" class="px-3 py-1 text-gray-600 hover:bg-gray-100 hover:text-red-600 transition">
                                                        <i class="fas fa-plus text-xs"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">Rp {{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="bg-gray-50">
                                <tr>
                                    <td colspan="3" class="px-6 py-4 text-right font-bold text-gray-900">Total</td>
                                    <td class="px-6 py-4 font-bold text-t-red">Rp {{ number_format($total, 0, ',', '.') }}</td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-between items-center">
                        <a href="{{ route('products') }}" class="text-sm text-gray-600 hover:text-gray-900">&larr; Continue Shopping</a>
                        <form action="{{ route('orders.checkout') }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-t-red hover-bg-t-red text-white font-bold py-2 px-6 rounded-lg shadow-sm transition duration-150 ease-in-out">
                                Checkout
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <!-- Empty Cart State -->
                <div class="flex flex-col items-center justify-center text-center">
                    <div class="bg-gray-100 rounded-full p-8 mb-6">
                        <i class="fas fa-shopping-cart text-4xl text-gray-500"></i>
                    </div>

                    <h2 class="text-xl font-medium text-gray-900 mb-2">Your cart is empty</h2>
                    <p class="text-gray-500 mb-8">Start adding items from our marketplace!</p>

                    <a href="{{ route('products') }}" class="bg-t-red hover-bg-t-red text-white font-bold py-3 px-8 rounded-lg transition duration-150 ease-in-out shadow-sm">
                        Browse Products
                    </a>
                </div>
            @endif

        </div>
    </div>

    @include('components.footer')

</body>
</html>
