<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Symfony\Component\HttpFoundation\StreamedResponse;

class OrderController extends Controller
{
    /**
     * Display filtered and sorted orders with export options.
     */
    public function index(Request $request)
    {
        $query = Order::with('items.product', 'user');

        // ✅ Filtering
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // ✅ Sorting
        if ($request->filled('sort')) {
            $sortField = $request->sort;
            $sortDirection = $request->input('direction', 'desc');
            $query->orderBy($sortField, $sortDirection);
        } else {
            $query->orderBy('created_at', 'desc');
        }

        // ✅ Export as PDF
        if ($request->has('export') && $request->export === 'pdf') {
            $orders = $query->get();
            $pdf = Pdf::loadView('admin.orders.export-pdf', ['orders' => $orders]);
            return $pdf->download('orders-export.pdf');
        }

        // ✅ Export as CSV
        if ($request->has('export') && $request->export === 'csv') {
            $orders = $query->get();
            $headers = ['Content-Type' => 'text/csv', 'Content-Disposition' => 'attachment; filename="orders-export.csv"'];

            $callback = function () use ($orders) {
                $handle = fopen('php://output', 'w');
                fputcsv($handle, ['Order ID', 'User', 'Total', 'Status', 'Created At']);
                foreach ($orders as $order) {
                    fputcsv($handle, [
                        $order->id,
                        optional($order->user)->name ?? 'Guest',
                        $order->total_amount,
                        ucfirst($order->status),
                        $order->created_at->format('Y-m-d H:i')
                    ]);
                }
                fclose($handle);
            };

            return new StreamedResponse($callback, 200, $headers);
        }

        $orders = $query->paginate(15)->appends($request->query());

        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load('items.product', 'user');
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate(['status' => 'required|in:pending,paid,cancelled,shipped']);
        $order->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Order status updated.');
    }
}