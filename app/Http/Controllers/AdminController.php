<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalUsers = User::count();
        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'pending_approval')->count();
        $totalProducts = Product::count();

        // New Stats
        $totalRevenue = Order::where('status', 'completed')->sum('total_price');
        $thirtyDaysAgo = Carbon::now()->subDays(30);
        $monthlyRevenue = Order::where('status', 'completed')
                               ->where('updated_at', '>=', $thirtyDaysAgo)
                               ->sum('total_price');
        $newUsers = User::where('created_at', '>=', $thirtyDaysAgo)->count();

        // Sales data for chart
        $salesData = Order::where('status', 'completed')
            ->where('updated_at', '>=', $thirtyDaysAgo)
            ->select(
                DB::raw('DATE(updated_at) as date'),
                DB::raw('SUM(total_price) as total')
            )
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        $salesChartLabels = [];
        $salesChartData = [];
        
        // Create a date range for the last 30 days
        $dateRange = Carbon::today()->subDays(29)->toPeriod(Carbon::today());

        $salesByDate = $salesData->keyBy('date');

        foreach ($dateRange as $date) {
            $formattedDate = $date->format('Y-m-d');
            $salesChartLabels[] = $date->format('M d');
            $salesChartData[] = $salesByDate->get($formattedDate, (object)['total' => 0])->total;
        }

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalOrders',
            'pendingOrders',
            'totalProducts',
            'totalRevenue',
            'monthlyRevenue',
            'newUsers',
            'salesChartLabels',
            'salesChartData'
        ));
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