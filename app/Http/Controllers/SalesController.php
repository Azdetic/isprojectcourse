<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderItem;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class SalesController extends Controller
{
    public function index()
    {
        // Get items sold by the current user
        $sales = OrderItem::whereHas('product', function ($query) {
            $query->where('user_id', Auth::id());
        })->with(['order.user', 'product'])->latest()->get();

        // Group items by Order ID
        $groupedSales = $sales->groupBy('order_id');

        return view('sales.index', compact('groupedSales'));
    }

    public function shipItem($id)
    {
        // In this simplified system, shipping an item ships the whole order.
        // We find the order associated with this item.

        $orderItem = OrderItem::with('order', 'product')->findOrFail($id);

        // Verify ownership
        if ($orderItem->product->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $order = $orderItem->order;

        if ($order->status === 'to_ship') {
            $order->update(['status' => 'to_receive']);
            return back()->with('success', 'Order marked as shipped.');
        }

        return back()->with('error', 'Order is not ready to ship.');
    }
}
