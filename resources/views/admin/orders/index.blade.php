@extends('layouts.admin')

@section('header', 'Manage Orders')

@section('content')
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Products</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($orders as $order)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#{{ $order->id }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $order->user->name }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500">
                        <ul class="list-disc list-inside">
                            @foreach($order->items as $item)
                                <li>{{ $item->product_name }} (x{{ $item->quantity }})</li>
                            @endforeach
                        </ul>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($order->status == 'pending_approval')
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending Approval</span>
                        @elseif($order->status == 'to_pay')
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">To Pay</span>
                        @elseif($order->status == 'to_ship')
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">To Ship</span>
                        @elseif($order->status == 'to_receive')
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-indigo-100 text-indigo-800">To Receive</span>
                        @elseif($order->status == 'completed')
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Completed</span>
                        @elseif($order->status == 'cancelled')
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Cancelled</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $order->created_at->format('M d, Y H:i') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        @if($order->status == 'pending_approval')
                            <form action="{{ route('admin.orders.approve', $order->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="text-green-600 hover:text-green-900 mr-3">Approve</button>
                            </form>
                            <form action="{{ route('admin.orders.reject', $order->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Reject this order?');">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="text-red-600 hover:text-red-900">Reject</button>
                            </form>
                        @elseif($order->status == 'to_ship')
                            <form action="{{ route('admin.orders.ship', $order->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="text-blue-600 hover:text-blue-900">Ship Order</button>
                            </form>
                        @else
                            <span class="text-gray-400">No actions</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
