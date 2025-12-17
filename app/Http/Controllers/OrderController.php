<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status', 'to_pay');
        $orders = Order::where('user_id', Auth::id())
                       ->where('status', $status)
                       ->with(['items', 'reviews'])
                       ->latest()
                       ->get();

        return view('orders.index', compact('orders', 'status'));
    }

    public function checkout()
    {
        $cart = session()->get('cart');

        if (!$cart || count($cart) == 0) {
            return redirect()->route('cart.index')->with('error', 'Cart is empty');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $order = Order::create([
            'user_id' => Auth::id(),
            'total_price' => $total,
            'status' => 'to_pay'
        ]);

        foreach ($cart as $id => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'product_name' => $item['name'],
                'product_image' => $item['image'] ?? 'https://via.placeholder.com/400x400?text=No+Image',
                'quantity' => $item['quantity'],
                'price' => $item['price']
            ]);
        }

        session()->forget('cart');

        return redirect()->route('orders.index', ['status' => 'to_pay'])->with('success', 'Order placed successfully!');
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::where('user_id', Auth::id())->findOrFail($id);

        // Simple state machine for demo purposes
        // In real app, this might be handled by payment gateway callbacks or admin panel
        if ($order->status == 'to_pay') {
            $order->update(['status' => 'to_ship']);
        } elseif ($order->status == 'to_ship') {
            $order->update(['status' => 'to_receive']);
        } elseif ($order->status == 'to_receive') {
            $order->update(['status' => 'completed']);
        }

        return redirect()->back()->with('success', 'Order status updated');
    }

    public function storeReview(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer',
            'order_id' => 'required|exists:orders,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string'
        ]);

        $existingReview = Review::where('user_id', Auth::id())
                                ->where('order_id', $request->order_id)
                                ->where('product_id', $request->product_id)
                                ->first();

        if ($existingReview) {
            return redirect()->back()->with('error', 'You have already reviewed this product for this order.');
        }

        Review::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
            'order_id' => $request->order_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'is_anonymous' => $request->has('is_anonymous')
        ]);

        return redirect()->back()->with('success', 'Review submitted successfully!');
    }
}
