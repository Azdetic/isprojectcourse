<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class ChatController extends Controller
{
    /**
     * Display a list of the user's conversations.
     */
    public function index()
    {
        $user = Auth::user();
        $conversations = Conversation::where('user_one', $user->id)
            ->orWhere('user_two', $user->id)
            ->with(['userOne', 'userTwo', 'messages' => function ($query) {
                $query->latest();
            }])
            ->get()
            ->map(function ($convo) use ($user) {
                // Determine the other user in the conversation
                $convo->otherUser = $convo->user_one == $user->id ? $convo->userTwo : $convo->userOne;
                return $convo;
            });
            
        return view('chat.index', compact('conversations'));
    }

    /**
     * Show a specific conversation.
     * This also handles starting a new conversation.
     */
    public function show(Request $request, $userId)
    {
        $user = Auth::user();
        $receiver = User::findOrFail($userId);
        $productContext = null;

        if ($request->has('product_id')) {
            $productContext = Product::find($request->query('product_id'));
        }

        if ($user->id === $receiver->id) {
            return redirect()->route('chat.index')->with('error', 'You cannot message yourself.');
        }

        $conversation = Conversation::where(function (Builder $query) use ($user, $receiver) {
            $query->where('user_one', $user->id)->where('user_two', $receiver->id);
        })->orWhere(function (Builder $query) use ($user, $receiver) {
            $query->where('user_one', $receiver->id)->where('user_two', $user->id);
        })->first();

        // If no conversation exists, create one
        if (!$conversation) {
            $conversation = Conversation::create([
                'user_one' => $user->id,
                'user_two' => $receiver->id,
            ]);
        }

        // Mark messages as read
        Message::where('conversation_id', $conversation->id)
            ->where('receiver_id', $user->id)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        $messages = Message::where('conversation_id', $conversation->id)->with('sender', 'product')->get();

        return view('chat.show', compact('conversation', 'messages', 'receiver', 'productContext'));
    }

    /**
     * Store a new message.
     */
    public function store(Request $request, $conversationId)
    {
        $request->validate([
            'body' => 'required|string',
            'product_id' => 'nullable|exists:products,id'
        ]);

        $conversation = Conversation::findOrFail($conversationId);

        // Determine the receiver
        $receiverId = $conversation->user_one == Auth::id() ? $conversation->user_two : $conversation->user_one;

        Message::create([
            'conversation_id' => $conversation->id,
            'sender_id' => Auth::id(),
            'receiver_id' => $receiverId,
            'body' => $request->body,
            'product_id' => $request->product_id,
        ]);

        return back()->with('success', 'Message sent!');
    }
}