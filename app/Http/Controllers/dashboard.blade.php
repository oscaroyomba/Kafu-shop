<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- ✅ Welcome Message --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>

            {{-- ✅ Filter Orders --}}
            <div class="bg-white shadow sm:rounded-lg p-4">
                <form method="GET" action="{{ route('dashboard') }}">
                    <label for="status" class="text-sm font-medium text-gray-700">Filter by status:</label>
                    <select name="status" id="status" class="border px-3 py-2 rounded ml-2" onchange="this.form.submit()">
                        <option value="">All</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="delivered" {{ request('status') == 'delivered' ? 'selected' : '' }}>Delivered</option>
                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        <option value="shipped" {{ request('status') == 'shipped' ? 'selected' : '' }}>Shipped</option>
                        <option value="returned" {{ request('status') == 'returned' ? 'selected' : '' }}>Returned</option>
                    </select>
                </form>
            </div>

            {{-- ✅ Recent Orders --}}
            <div class="bg-white shadow sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-bold mb-4">Recent Orders</h3>

                    @if($orders->count())
                        <table class="w-full text-left text-sm border-collapse">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="p-2 border-b">Order ID</th>
                                    <th class="p-2 border-b">Total</th>
                                    <th class="p-2 border-b">Status</th>
                                    <th class="p-2 border-b">Date</th>
                                    <th class="p-2 border-b text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                    <tr class="hover:bg-gray-50 border-b">
                                        <td class="p-2">#{{ $order->id }}</td>
                                        <td class="p-2">ETB {{ number_format($order->total_amount, 2) }}</td>
                                        <td class="p-2">
                                            @php
                                                $badgeClasses = match($order->status) {
                                                    'delivered' => 'bg-green-100 text-green-700',
                                                    'pending' => 'bg-orange-100 text-orange-700',
                                                    'cancelled' => 'bg-red-100 text-red-700',
                                                    'shipped' => 'bg-blue-100 text-blue-700',
                                                    'returned' => 'bg-purple-100 text-purple-700',
                                                    default => 'bg-gray-100 text-gray-700',
                                                };
                                            @endphp
                                            <span class="px-2 py-1 text-xs rounded {{ $badgeClasses }}">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </td>
                                        <td class="p-2">{{ $order->created_at->format('M d, Y') }}</td>
                                        <td class="p-2 text-right">
                                            <a href="{{ route('orders.show', $order->id) }}" class="text-blue-600 hover:underline">View</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{-- ✅ Pagination Links --}}
                        <div class="mt-4">
                            {{ $orders->appends(request()->query())->links() }}
                        </div>
                    @else
                        <p class="text-gray-600">You haven’t placed any orders yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>