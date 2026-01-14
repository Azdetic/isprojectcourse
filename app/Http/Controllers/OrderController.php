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

    public function checkout(Request $request)
    {
        $cart = session()->get('cart');
        $selectedItemIds = $request->input('selected_items', []);

        if (!$cart || empty($selectedItemIds)) {
            return redirect()->route('cart.index')->with('error', 'Please select at least one item to checkout.');
        }

        // Fetch all products from the database at once for efficiency
        $productsInCart = \App\Models\Product::findMany($selectedItemIds);
        
        if ($productsInCart->count() !== count($selectedItemIds)) {
            return redirect()->route('cart.index')->with('error', 'Some selected items were not found.');
        }

        $total = 0;
        $orderItemsData = [];

        foreach ($productsInCart as $product) {
            $quantity = $cart[$product->id]['quantity'] ?? 0;
            if ($quantity > 0) {
                // Use the price from the database for calculation
                $total += $product->price * $quantity;
                $orderItemsData[] = [
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'product_image' => $product->image,
                    'quantity' => $quantity,
                    'price' => $product->price // Authoritative price from DB
                ];
            }
        }

        if (empty($orderItemsData)) {
             return redirect()->route('cart.index')->with('error', 'No valid items to checkout.');
        }

        $order = Order::create([
            'user_id' => Auth::id(),
            'total_price' => $total,
            'status' => 'to_pay'
        ]);

        foreach ($orderItemsData as $itemData) {
            $itemData['order_id'] = $order->id;
            OrderItem::create($itemData);
            
            // Remove only checked out items from cart
            unset($cart[$itemData['product_id']]);
        }

        session()->put('cart', $cart);

        return redirect()->route('orders.index', ['status' => 'to_pay'])->with('success', 'Order placed successfully!');
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::where('user_id', Auth::id())->findOrFail($id);

        // Simple state machine for demo purposes
        // In real app, this might be handled by payment gateway callbacks or admin panel
        if ($order->status == 'to_pay') {
            // Instead of going to 'to_ship', it goes to 'pending_approval'
            $order->update(['status' => 'pending_approval']);
            return redirect()->route('orders.index', ['status' => 'pending_approval'])->with('success', 'Payment submitted. Waiting for admin approval.');
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
