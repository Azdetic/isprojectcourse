<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="TMarket is the official student marketplace for Telkom University. Buy and sell textbooks, electronics, and dorm essentials safely.">
    
    <title>TMarket - Home | Telkom University Marketplace</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
        }
        .t-red { color: #D12026; }
        .bg-t-red { background-color: #D12026; }
        a:focus-visible, button:focus-visible {
            outline: 3px solid #D12026;
            outline-offset: 2px;
        }
    </style>
</head>
<body class="bg-gray-50 flex flex-col min-h-screen">

    @include('components.navbar')

    <main id="main-content" class="flex-grow">
        
        <section aria-label="Welcome to TMarket" class="relative h-[550px] w-full bg-white group">
            <div class="absolute inset-0 z-0 overflow-hidden">
                <div class="absolute inset-0 bg-cover bg-center transition-transform duration-[10s] group-hover:scale-105"
                     style="background-image: url('{{ asset('images/telkomuniv.jpg') }}');"
                     role="img" 
                     aria-label="Telkom University Campus Background">
                </div>
                <div class="absolute inset-0 bg-gradient-to-r from-[#B91C1C]/95 via-red-900/80 to-slate-900/60 mix-blend-multiply"></div>
            </div>

            <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex flex-col justify-center pb-10">
                <div class="max-w-3xl">
                    <div class="inline-flex items-center gap-2 py-1.5 px-4 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-white text-xs font-bold uppercase tracking-wider mb-6 shadow-sm">
                        <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse" aria-hidden="true"></span>
                        Official Marketplace for Telkom University
                    </div>

                    <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-6 leading-tight drop-shadow-lg">
                        Buy, Sell, & Connect <br/>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-100 via-white to-red-100">With Your Campus.</span>
                    </h1>

                    <p class="text-lg md:text-xl text-red-50 mb-8 max-w-xl leading-relaxed font-medium">
                        Your exclusive marketplace for buying and selling textbooks, electronics, and essentials with fellow Telkom University students.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('products') }}" 
                           class="px-8 py-4 bg-white text-[#B91C1C] rounded-xl font-bold hover:bg-gray-50 transition shadow-xl shadow-red-900/20 transform hover:-translate-y-1 flex items-center justify-center gap-2"
                           aria-label="Explore deals on campus products">
                            <span>Explore Deals</span>
                            <i class="fas fa-arrow-right" aria-hidden="true"></i>
                        </a>
                        <a href="{{ route('my-products.create') }}" 
                           class="px-8 py-4 bg-transparent border-2 border-white/30 text-white rounded-xl font-bold hover:bg-white/10 backdrop-blur-sm transition flex items-center justify-center"
                           aria-label="Sell an item on the marketplace">
                            Start Selling
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <section aria-labelledby="categories-heading" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <h2 id="categories-heading" class="text-2xl font-bold text-gray-900 mb-6">What Are You Looking For?</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                @php
                    $categoryItems = [
                        ['name' => 'Books', 'icon' => 'fa-book'],
                        ['name' => 'Electronics', 'icon' => 'fa-laptop'],
                        ['name' => 'Fashion', 'icon' => 'fa-tshirt'],
                        ['name' => 'Stationery', 'icon' => 'fa-pencil-alt'],
                        ['name' => 'Food', 'icon' => 'fa-utensils'],
                        ['name' => 'Others', 'icon' => 'fa-ellipsis-h']
                    ];
                @endphp
                @foreach($categoryItems as $cat)
                    <a href="{{ route('products', ['search' => $cat['name']]) }}" class="group bg-white p-4 rounded-xl shadow-sm hover:shadow-md transition border border-gray-100 text-center">
                        <div class="w-12 h-12 mx-auto bg-red-50 rounded-full flex items-center justify-center mb-3 group-hover:bg-red-100 transition">
                            <i class="fas {{ $cat['icon'] }} text-t-red text-xl" aria-hidden="true"></i>
                        </div>
                        <span class="text-sm font-bold text-gray-800 group-hover:text-t-red">{{ $cat['name'] }}</span>
                    </a>
                @endforeach
            </div>
        </section>

        <section aria-labelledby="trending-heading" class="bg-white py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center mb-6">
                    <h2 id="trending-heading" class="text-2xl font-bold text-gray-900">Trending Now</h2>
                    <a href="{{ route('products') }}" class="text-t-red font-bold hover:text-red-700" aria-label="View all trending products">
                        View All <i class="fas fa-arrow-right ml-1" aria-hidden="true"></i>
                    </a>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @forelse($trendingProducts as $product)
                        <x-product-card :product="$product" />
                    @empty
                        <div class="col-span-full text-center py-10">
                            <i class="fas fa-box-open text-gray-300 text-6xl mb-4" aria-hidden="true"></i>
                            <p class="text-gray-600 text-lg font-medium">No products available yet.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>
    </main>

    @include('components.footer')

</body>
</html>