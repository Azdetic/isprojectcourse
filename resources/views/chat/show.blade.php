@extends('layouts.app')

@section('title', 'Chat with ' . $receiver->name)

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10 h-full">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 flex flex-col h-[75vh]">

        <!-- Header -->
        <div class="p-4 border-b border-gray-100 flex items-center gap-4">
            <a href="{{ route('chat.index') }}" class="text-gray-500 hover:text-gray-800">
                <i class="fas fa-arrow-left"></i>
            </a>
            <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name={{ urlencode($receiver->name) }}&background=B91C1C&color=fff&bold=true" alt="{{ $receiver->name }}">
            <h2 class="text-lg font-bold text-gray-900">{{ $receiver->name }}</h2>
        </div>

        <!-- Messages -->
        <div class="flex-1 p-6 space-y-4 overflow-y-auto">
            @foreach($messages as $message)
                @if($message->sender_id === Auth::id())
                    <!-- Sent Message -->
                    <div class="flex justify-end">
                        <div class="bg-[#B91C1C] text-white p-3 rounded-l-xl rounded-br-xl max-w-md">
                            @if ($message->product)
                            <div class="bg-red-800/50 p-2 rounded-lg mb-2">
                                <div class="flex items-center gap-3">
                                    <img src="{{ Str::startsWith($message->product->image, 'http') || !Storage::disk('public')->exists($message->product->image) ? asset($message->product->image) : Storage::url($message->product->image) }}" class="w-10 h-10 rounded-md object-cover">
                                    <div>
                                        <p class="text-xs text-red-100">Regarding:</p>
                                        <a href="{{ route('product-detail', $message->product->id) }}" class="text-sm font-bold text-white hover:underline line-clamp-1">
                                            {{ $message->product->name }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <p class="text-sm">{{ $message->body }}</p>
                            <time class="text-xs text-red-100 mt-1 block text-right">{{ $message->created_at->format('h:i A') }}</time>
                        </div>
                    </div>
                @else
                    <!-- Received Message -->
                    <div class="flex justify-start">
                        <div class="bg-gray-100 p-3 rounded-r-xl rounded-bl-xl max-w-md">
                            @if ($message->product)
                            <div class="bg-gray-200 p-2 rounded-lg mb-2">
                                <div class="flex items-center gap-3">
                                    <img src="{{ Str::startsWith($message->product->image, 'http') || !Storage::disk('public')->exists($message->product->image) ? asset($message->product->image) : Storage::url($message->product->image) }}" class="w-10 h-10 rounded-md object-cover">
                                    <div>
                                        <p class="text-xs text-gray-500">Regarding:</p>
                                        <a href="{{ route('product-detail', $message->product->id) }}" class="text-sm font-bold text-gray-800 hover:text-[#B91C1C] transition line-clamp-1">
                                            {{ $message->product->name }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <p class="text-sm text-gray-800">{{ $message->body }}</p>
                            <time class="text-xs text-gray-400 mt-1 block">{{ $message->created_at->format('h:i A') }}</time>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <!-- Message Input -->
        <div class="p-4 border-t border-gray-100">
            <form action="{{ route('chat.store', $conversation->id) }}" method="POST">
                @csrf
                @if($messages->isEmpty() && $productContext)
                    <input type="hidden" name="product_id" value="{{ $productContext->id }}">
                @endif
                <div class="flex items-center gap-2">
                    <input type="text" name="body" class="w-full bg-gray-50 border-gray-200 rounded-xl px-4 py-3 text-gray-900 font-medium focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#B91C1C]/20 focus:border-[#B91C1C] transition" placeholder="Type a message..." required autocomplete="off">
                    <button type="submit" class="w-12 h-12 flex-shrink-0 bg-[#B91C1C] text-white font-bold rounded-xl hover:bg-red-800 transition shadow-lg shadow-red-900/20 active:scale-[0.98] flex items-center justify-center">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
