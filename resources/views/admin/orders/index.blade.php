@extends('layouts.admin')

@section('header', 'Manage Orders')

@section('content')
    
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-100">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Order ID</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">User</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Products</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Total</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse($orders as $order)
                    <tr class="hover:bg-gray-50 transition duration-150">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                            #{{ $order->id }}
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-8 w-8">
                                    <img class="h-8 w-8 rounded-full border border-gray-200" 
                                         src="https://ui-avatars.com/api/?name={{ urlencode($order->user->name) }}&background=B91C1C&color=fff&bold=true" 
                                         alt="">
                                </div>
                                <div class="ml-3">
                                    <div class="text-sm font-medium text-gray-900">{{ $order->user->name }}</div>
                                    <div class="text-xs text-gray-500">{{ $order->user->email }}</div>
                                </div>
                            </div>
                        </td>

                        <td class="px-6 py-4 text-sm text-gray-500 max-w-xs">
                            <ul class="space-y-1">
                                @foreach($order->items as $item)
                                    <li class="flex items-center gap-2">
                                        <i class="fas fa-circle text-[4px] text-gray-300"></i>
                                        <span class="truncate">{{ $item->product_name }}</span> 
                                        <span class="text-xs font-bold text-gray-400">x{{ $item->quantity }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-[#B91C1C]">
                            Rp {{ number_format($order->total_price, 0, ',', '.') }}
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($order->status == 'pending_approval')
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-yellow-50 text-yellow-700 border border-yellow-200">
                                    <i class="fas fa-clock mr-1.5 mt-0.5"></i> Pending Approval
                                </span>
                            @elseif($order->status == 'to_pay')
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-gray-100 text-gray-600 border border-gray-200">
                                    <i class="fas fa-wallet mr-1.5 mt-0.5"></i> To Pay
                                </span>
                            @elseif($order->status == 'to_ship')
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-blue-50 text-blue-700 border border-blue-200">
                                    <i class="fas fa-box mr-1.5 mt-0.5"></i> To Ship
                                </span>
                            @elseif($order->status == 'to_receive')
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-indigo-50 text-indigo-700 border border-indigo-200">
                                    <i class="fas fa-truck mr-1.5 mt-0.5"></i> To Receive
                                </span>
                            @elseif($order->status == 'completed')
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-green-50 text-green-700 border border-green-200">
                                    <i class="fas fa-check-circle mr-1.5 mt-0.5"></i> Completed
                                </span>
                            @elseif($order->status == 'cancelled')
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-red-50 text-red-700 border border-red-200">
                                    <i class="fas fa-times-circle mr-1.5 mt-0.5"></i> Cancelled
                                </span>
                            @endif
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-500 font-medium">
                            {{ $order->created_at->format('M d, Y') }} <br>
                            <span class="text-gray-400">{{ $order->created_at->format('H:i') }}</span>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            @if($order->status == 'pending_approval')
                                <div class="flex items-center justify-end gap-2">
                                    <form action="{{ route('admin.orders.approve', $order->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="bg-green-50 hover:bg-green-100 text-green-600 p-2 rounded-lg transition duration-200" title="Approve">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.orders.reject', $order->id) }}" method="POST" onsubmit="return confirm('Reject this order?');">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="bg-red-50 hover:bg-red-100 text-red-600 p-2 rounded-lg transition duration-200" title="Reject">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </form>
                                </div>
                            @elseif($order->status == 'to_ship')
                                <form action="{{ route('admin.orders.ship', $order->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-bold rounded-lg text-blue-700 bg-blue-50 hover:bg-blue-100 transition focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        <i class="fas fa-shipping-fast mr-1.5"></i> Ship Order
                                    </button>
                                </form>
                            @else
                                <span class="text-gray-300 italic text-xs">No actions</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center text-gray-400">
                                <i class="fas fa-shopping-basket text-4xl mb-3"></i>
                                <span class="text-sm font-medium">No orders found.</span>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if(method_exists($orders, 'links'))
            <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
                {{ $orders->links() }}
            </div>
        @endif
    </div>
@endsection