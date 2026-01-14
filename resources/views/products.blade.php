<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Browse and shop items from Telkom University students on TMarket.">
    
    <title>Browse Products - TMarket</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        a:focus-visible, button:focus-visible {
            outline: 3px solid #B91C1C;
            outline-offset: 2px;
        }
    </style>
</head>
<body class="bg-gray-50 flex flex-col min-h-screen">

    @include('components.navbar')

    <main id="main-content" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 flex-grow w-full">

        <header class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight mb-2">
                    @if($search ?? false)
                        Search Results for "{{ $search }}" {{ ($category ?? false) ? "in $category" : "" }}
                    @elseif($category ?? false)
                        {{ $category }} Products
                    @else
                        Browse Products
                    @endif
                </h1>
                <p class="text-gray-600 font-medium">
                    @if($search ?? false)
                        Found {{ $products->total() }} product{{ $products->total() !== 1 ? 's' : '' }} matching your search.
                    @elseif($category ?? false)
                        Found {{ $products->total() }} product{{ $products->total() !== 1 ? 's' : '' }} in {{ $category }}.
                    @else
                        Discover unique items from your fellow Telkom University students.
                    @endif
                </p>
            </div>
            @if(($search ?? false) || ($category ?? false))
                <a href="{{ route('products') }}" class="text-[#B91C1C] hover:text-red-700 font-bold flex items-center gap-2">
                    <i class="fas fa-times" aria-hidden="true"></i> Clear Filters
                </a>
            @endif
        </header>

        {{-- Filters Section --}}
        <section aria-label="Product Filters" class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 mb-8">
            <div class="flex flex-col md:flex-row md:items-center justify-between space-y-4 md:space-y-0">
                <div class="flex items-center gap-4">
                    <span class="text-gray-600 font-bold text-xs uppercase tracking-wider whitespace-nowrap">Filter:</span>

                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" 
                                aria-haspopup="listbox" 
                                :aria-expanded="open"
                                aria-label="Filter by category"
                                class="bg-gray-100 hover:bg-gray-200 px-4 py-2 rounded-xl text-sm font-bold flex items-center gap-2 transition min-w-[140px] justify-between">
                            <span>{{ ($category ?? false) ? $category : 'All Items' }}</span>
                            <i class="fas fa-chevron-down text-xs transition" :class="{ 'rotate-180': open }" aria-hidden="true"></i>
                        </button>

                        <ul x-show="open" @click.away="open = false" x-transition class="absolute top-full mt-2 bg-white border border-gray-200 rounded-xl shadow-lg z-50 min-w-[140px] py-2" role="listbox">
                             <li>
                                <a href="{{ route('products') }}" class="block px-4 py-2 text-sm hover:bg-gray-50 {{ (!$search && !$category) ? 'text-[#B91C1C] font-bold' : 'text-gray-700' }}">
                                    All Items
                                </a>
                            </li>
                            @foreach(['Books', 'Electronics', 'Fashion', 'Stationery', 'Food', 'Other'] as $cat)
                                <li>
                                    <a href="{{ route('products', ['category' => $cat] + ($search ? ['search' => $search] : [])) }}"
                                       class="block px-4 py-2 text-sm hover:bg-gray-50 {{ $category == $cat ? 'text-[#B91C1C] font-bold' : 'text-gray-700' }}">
                                        {{ $cat }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        {{-- Product Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse($products as $product)
                <x-product-card :product="$product" />
            @empty
                <div class="sm:col-span-2 lg:col-span-3 xl:col-span-4 bg-white rounded-2xl border border-gray-100 shadow-sm text-center p-12">
                    <i class="fas fa-search-dollar text-4xl text-gray-300 mb-4"></i>
                    <h2 class="text-xl font-bold text-gray-800">No Products Found</h2>
                    <p class="text-gray-600 mt-2">
                        We couldn't find any products matching your criteria. Try clearing your filters or searching for something else!
                    </p>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if(method_exists($products, 'links'))
        <nav aria-label="Pagination" class="mt-8">
            {{ $products->appends(request()->query())->links() }}
        </nav>
        @endif

    </main>

    @include('components.footer')

</body>
</html>