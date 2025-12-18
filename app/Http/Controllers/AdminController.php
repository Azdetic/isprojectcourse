<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalUsers = User::count();
        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'pending_approval')->count();
        $totalProducts = Product::count();

        return view('admin.dashboard', compact('totalUsers', 'totalOrders', 'pendingOrders', 'totalProducts'));
    }

    public function users()
    {
        $users = User::latest()->get();
        return view('admin.users.index', compact('users'));
    }

    public function destroyUser($id)
    {
        $user = User::findOrFail($id);
        // Prevent deleting self
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Cannot delete yourself.');
        }
        $user->delete();
        return back()->with('success', 'User deleted successfully.');
    }

    public function orders()
    {
        $orders = Order::with('user', 'items')->latest()->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function approveOrder($id)
    {
        $order = Order::findOrFail($id);
        if ($order->status === 'pending_approval') {
            $order->update(['status' => 'to_ship']);
            return back()->with('success', 'Order approved and moved to To Ship.');
        }
        return back()->with('error', 'Order status is not pending approval.');
    }

    public function rejectOrder($id)
    {
        $order = Order::findOrFail($id);
        if ($order->status === 'pending_approval') {
            // Option 1: Cancel it
            // Option 2: Move back to to_pay? Let's cancel it or delete it.
            // User asked for "decline". Let's set status to 'cancelled' or just delete.
            // Let's assume 'cancelled' status exists or we just revert to 'to_pay' with a message?
            // For simplicity, let's revert to 'to_pay' so user can try again, or 'cancelled'.
            // Let's use 'cancelled'.
            $order->update(['status' => 'cancelled']);
            return back()->with('success', 'Order rejected/cancelled.');
        }
        return back()->with('error', 'Order status is not pending approval.');
    }

    public function shipOrder($id)
    {
        $order = Order::findOrFail($id);
        if ($order->status === 'to_ship') {
            $order->update(['status' => 'to_receive']);
            return back()->with('success', 'Order marked as shipped.');
        }
        return back()->with('error', 'Order status is not ready to ship.');
    }

    public function products()
    {
        $products = Product::with('seller')->latest()->get();
        return view('admin.products.index', compact('products'));
    }

    public function destroyProduct($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return back()->with('success', 'Product deleted successfully.');
    }
}
