<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('meta')

    <title>@yield('title', 'TMarket - Telkom University Marketplace')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        /* Hides scrollbar but allows scrolling */
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        
        /* Accessibility: Skip to Content link styling */
        .skip-link {
            position: absolute;
            top: -40px;
            left: 0;
            background: #e31b23; 
            color: white;
            padding: 8px;
            z-index: 100;
            transition: top 0.3s;
        }
        .skip-link:focus {
            top: 0;
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-900 flex flex-col min-h-screen">
    
    <a href="#main-content" class="skip-link">Skip to main content</a>

    @include('layouts.navbar')

    <main id="main-content" class="flex-grow focus:outline-none" tabindex="-1">
        @yield('content')
    </main>

    @include('layouts.footer')

</body>
</html>