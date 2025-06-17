<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user', 'items.product')
                    ->orderBy('created_at', 'desc')
                    ->paginate(15);

        return view('admin.orders.index', compact('orders'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|string|in:pending,paid,shipped,cancelled',
        ]);

        $order->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Order status updated.');
    }
}