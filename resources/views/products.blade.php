<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TMarket - Products</title>
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
        .hover-bg-t-red:hover { background-color: #b01b20; }
        .btn-outline-red {
            border: 1px solid #D12026;
            color: #D12026;
        }
        .btn-outline-red:hover {
            background-color: #D12026;
            color: white;
        }
        /* Hide scrollbar for Chrome, Safari and Opera */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        /* Hide scrollbar for IE, Edge and Firefox */
        .no-scrollbar {
            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: none;  /* Firefox */
        }
    </style>
</head>
<body class="bg-white">

    <!-- Navbar -->
    @include('components.navbar')

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <!-- Page Title Section -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Browse Products</h1>
            <p class="text-gray-500">Discover items from your fellow Telkom University students</p>
        </div>

        <!-- Filter Section -->
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 space-y-4 md:space-y-0">
            <div class="flex items-center overflow-x-auto no-scrollbar pb-2 md:pb-0">
                <span class="text-gray-500 mr-4 whitespace-nowrap">Filter by category:</span>
                <div class="flex space-x-2">
                    <button class="bg-t-red text-white px-4 py-1.5 rounded-full text-sm font-medium whitespace-nowrap shadow-sm">All</button>
                    <button class="bg-white border border-gray-200 text-gray-600 px-4 py-1.5 rounded-full text-sm font-medium hover:border-red-500 hover:text-red-500 transition whitespace-nowrap">Food</button>
                    <button class="bg-white border border-gray-200 text-gray-600 px-4 py-1.5 rounded-full text-sm font-medium hover:border-red-500 hover:text-red-500 transition whitespace-nowrap">Secondhand Goods</button>
                    <button class="bg-white border border-gray-200 text-gray-600 px-4 py-1.5 rounded-full text-sm font-medium hover:border-red-500 hover:text-red-500 transition whitespace-nowrap">Digital Services</button>
                    <button class="bg-white border border-gray-200 text-gray-600 px-4 py-1.5 rounded-full text-sm font-medium hover:border-red-500 hover:text-red-500 transition whitespace-nowrap">Stationery</button>
                    <button class="bg-white border border-gray-200 text-gray-600 px-4 py-1.5 rounded-full text-sm font-medium hover:border-red-500 hover:text-red-500 transition whitespace-nowrap">Fashion</button>
                </div>
            </div>
            <div class="text-gray-500 text-sm font-medium whitespace-nowrap">
                {{ count($products) }} products found
            </div>
        </div>

        <!-- Products Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($products as $index => $product)
            <!-- Product Card -->
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition duration-300 overflow-hidden flex flex-col h-full">
                <!-- Image Container -->
                <div class="relative h-64 bg-gray-100 group">
                    <a href="{{ route('product-detail', ['id' => $index]) }}" class="block w-full h-full">
                        <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                    </a>
                    <!-- Category Badge -->
                    <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full border border-red-100 shadow-sm pointer-events-none">
                        <span class="text-xs font-semibold t-red">{{ $product['category'] }}</span>
                    </div>
                </div>

                <!-- Content -->
                <div class="p-5 flex flex-col flex-grow">
                    <a href="{{ route('product-detail', ['id' => $index]) }}" class="hover:text-red-600 transition">
                        <h3 class="font-bold text-gray-900 text-lg mb-1 line-clamp-1">{{ $product['name'] }}</h3>
                    </a>
                    <div class="text-xl font-bold t-red mb-2">Rp {{ number_format($product['price'], 0, ',', '.') }}</div>
                    <div class="text-sm text-gray-500 mb-6">Seller: {{ $product['seller'] }}</div>

                    <!-- Buttons -->
                    <div class="mt-auto grid grid-cols-2 gap-3">
                        <a href="{{ route('product-detail', ['id' => $index]) }}" class="w-full py-2 rounded-lg border border-gray-300 text-gray-700 font-medium text-sm hover:border-red-500 hover:text-red-500 transition flex items-center justify-center">
                            View Details
                        </a>
                        <button class="w-full py-2 rounded-lg bg-t-red text-white font-medium text-sm hover:bg-red-700 transition shadow-sm">
                            Add to Cart
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

    </div>

    <!-- Footer -->
    @include('components.footer')

</body>
</html>
