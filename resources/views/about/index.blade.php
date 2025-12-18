<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>About Us - TMarket</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style> body { font-family: 'Plus Jakarta Sans', sans-serif; } </style>
</head>
<body class="bg-gray-50 flex flex-col min-h-screen selection:bg-red-100 selection:text-red-900">

    @include('components.navbar')

    <div class="relative h-[550px] flex items-center justify-center overflow-hidden">
        
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/telkomuniv.jpg') }}" alt="Telkom University Campus" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-b from-gray-900/80 via-gray-900/60 to-gray-900/90 mix-blend-multiply"></div>
        </div>

        <div class="relative z-10 max-w-4xl mx-auto px-4 text-center -mt-20"> <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-white text-xs font-bold uppercase tracking-wider mb-6">
                <span class="w-2 h-2 rounded-full bg-[#B91C1C]"></span> Since 2025
            </span>
            <h1 class="text-5xl md:text-7xl font-extrabold text-white tracking-tight mb-6 leading-tight drop-shadow-lg">
                For Students.<br>By Students.
            </h1>
            <p class="text-lg md:text-xl text-gray-200 max-w-2xl mx-auto font-medium leading-relaxed drop-shadow-md">
                The official student marketplace of Telkom University. A safe space to buy, sell, and connect.
            </p>
            
            @auth
                <div class="mt-8">
                    <a href="{{ route('about.manage') }}" class="inline-flex items-center px-6 py-3 bg-white text-[#B91C1C] rounded-full text-sm font-bold shadow-lg hover:bg-gray-100 transition-all transform hover:-translate-y-1">
                        <i class="fas fa-pen mr-2"></i> Manage Content
                    </a>
                </div>
            @endauth
        </div>
    </div>

    <div class="relative z-20 -mt-32 pb-20"> 
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">
                
                <div class="bg-white p-8 rounded-3xl shadow-xl shadow-gray-900/10 border border-gray-100 transform hover:-translate-y-2 transition duration-300">
                    <div class="w-14 h-14 bg-red-50 rounded-2xl flex items-center justify-center text-[#B91C1C] mb-6">
                        <i class="fas fa-shield-alt text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Safe & Trusted</h3>
                    <p class="text-gray-500 leading-relaxed text-sm">
                        Verified Telkom University students only. No anonymous scammers, just your trusted campus peers.
                    </p>
                </div>

                <div class="bg-white p-8 rounded-3xl shadow-xl shadow-gray-900/10 border border-gray-100 transform hover:-translate-y-2 transition duration-300">
                    <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600 mb-6">
                        <i class="fas fa-wallet text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Student Friendly</h3>
                    <p class="text-gray-500 leading-relaxed text-sm">
                        Prices that fit a student budget. Find textbooks, electronics, and dorm essentials for less.
                    </p>
                </div>

                <div class="bg-white p-8 rounded-3xl shadow-xl shadow-gray-900/10 border border-gray-100 transform hover:-translate-y-2 transition duration-300">
                    <div class="w-14 h-14 bg-green-50 rounded-2xl flex items-center justify-center text-green-600 mb-6">
                        <i class="fas fa-leaf text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Sustainable</h3>
                    <p class="text-gray-500 leading-relaxed text-sm">
                        Give pre-loved items a second life. Buying secondhand supports a circular economy on campus.
                    </p>
                </div>

            </div>
        </div>
    </div>

    <div class="bg-white pb-24 pt-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="flex items-center justify-between mb-16 border-b border-gray-100 pb-6">
                <div>
                    <span class="text-[#B91C1C] font-bold text-sm tracking-widest uppercase block mb-1">Our Journey</span>
                    <h2 class="text-3xl font-extrabold text-gray-900">Latest Updates</h2>
                </div>
                <div class="hidden md:flex gap-2">
                    <div class="w-2 h-2 rounded-full bg-gray-200"></div>
                    <div class="w-2 h-2 rounded-full bg-gray-300"></div>
                    <div class="w-2 h-2 rounded-full bg-[#B91C1C]"></div>
                </div>
            </div>

            <div class="space-y-24">
                @forelse($sections as $index => $section)
                    <div class="flex flex-col md:flex-row items-center gap-12 lg:gap-20 {{ $index % 2 == 1 ? 'md:flex-row-reverse' : '' }}">
                        
                        @if($section->image)
                            <div class="w-full md:w-1/2 relative group cursor-pointer">
                                <div class="absolute inset-0 bg-gray-100 rounded-3xl transform rotate-3 transition duration-300 group-hover:rotate-1"></div>
                                <div class="relative rounded-3xl overflow-hidden aspect-[4/3] shadow-lg bg-white border border-gray-100">
                                     <img src="{{ Str::startsWith($section->image, 'http') ? $section->image : asset($section->image) }}" 
                                          alt="{{ $section->title }}" 
                                          class="w-full h-full object-cover transform group-hover:scale-105 transition duration-700 ease-in-out">
                                </div>
                            </div>
                        @endif

                        <div class="flex-1 {{ !$section->image ? 'w-full text-center max-w-4xl mx-auto' : '' }}">
                            <div class="flex items-center gap-3 mb-6 {{ !$section->image ? 'justify-center' : '' }}">
                                <span class="px-3 py-1 rounded-full bg-red-50 text-[#B91C1C] text-xs font-bold uppercase tracking-wide border border-red-100">
                                    Update
                                </span>
                                <span class="text-gray-400 text-sm font-medium">
                                    {{ $section->updated_at->format('M d, Y') }}
                                </span>
                            </div>
                            
                            <h2 class="text-3xl font-bold text-gray-900 mb-6 leading-tight">
                                {{ $section->title }}
                            </h2>
                            
                            <div class="prose prose-lg text-gray-500 prose-red leading-relaxed">
                                {!! nl2br(e($section->content)) !!}
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="flex flex-col items-center justify-center py-12 text-center bg-gray-50 rounded-3xl border border-dashed border-gray-200">
                        <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center shadow-sm mb-4">
                            <i class="far fa-newspaper text-2xl text-gray-300"></i>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900">No stories yet</h3>
                        <p class="text-gray-500 mt-1">Check back soon for updates!</p>
                    </div>
                @endforelse
            </div>

        </div>
    </div>

    @include('components.footer')

</body>
</html>