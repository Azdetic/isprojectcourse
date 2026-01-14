@extends('layouts.app')

@section('title', 'Feature Coming Soon')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center">
    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-8 text-gray-400">
        <i class="fas fa-cogs text-5xl"></i>
    </div>
    <h1 class="text-4xl font-extrabold text-gray-900 mb-4">
        Feature Coming Soon!
    </h1>
    <p class="text-lg text-gray-600 max-w-2xl mx-auto">
        Our team is working hard to bring this feature to you. Please check back later for an update. We appreciate your patience!
    </p>
    <a href="{{ url()->previous() }}" class="mt-10 inline-block bg-[#B91C1C] text-white px-8 py-3 rounded-xl text-sm font-bold hover:bg-red-800 transition shadow-lg shadow-red-900/20">
        <i class="fas fa-arrow-left mr-2"></i>
        Go Back
    </a>
</div>
@endsection
