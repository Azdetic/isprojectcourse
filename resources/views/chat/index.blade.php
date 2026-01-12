@extends('layouts.app')

@section('title', 'My Messages')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-gray-900">My Messages</h1>
        <p class="text-gray-500 font-medium">View your conversations with other students.</p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
        <ul class="divide-y divide-gray-100">
            @forelse($conversations as $conversation)
                <li class="hover:bg-gray-50 transition">
                    <a href="{{ route('chat.show', $conversation->otherUser->id) }}" class="p-6 flex items-center gap-4">
                        <div class="flex-shrink-0">
                            <img class="h-12 w-12 rounded-full border-2 border-white shadow-sm" src="https://ui-avatars.com/api/?name={{ urlencode($conversation->otherUser->name) }}&background=B91C1C&color=fff&bold=true" alt="{{ $conversation->otherUser->name }}">
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex justify-between items-center">
                                <p class="text-sm font-bold text-gray-900 truncate">{{ $conversation->otherUser->name }}</p>
                                <time class="text-xs text-gray-400 font-medium">{{ $conversation->messages->first()?->created_at->diffForHumans() }}</time>
                            </div>
                            <p class="text-sm text-gray-500 truncate mt-1">
                                {{ $conversation->messages->first()?->body }}
                            </p>
                        </div>
                    </a>
                </li>
            @empty
                <li class="p-12 text-center">
                    <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6 text-gray-300">
                        <i class="far fa-comment-dots text-4xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-1">No conversations yet</h3>
                    <p class="text-gray-500 text-sm">Start a conversation by clicking the "Chat Seller" button on a product page.</p>
                </li>
            @endforelse
        </ul>
    </div>
</div>
@endsection
