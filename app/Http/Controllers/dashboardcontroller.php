<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // 📊 Monthly sales & order data (e.g., "2025-05", "2025-06", etc.)
        $chartData = Order::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as orders, SUM(total_amount) as sales')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $chartLabels = $chartData->pluck('month');
        $chartOrders = $chartData->pluck('orders');
        $chartSales = $chartData->pluck('sales');

        return view('admin.dashboard', compact('chartLabels', 'chartOrders', 'chartSales'));
    }
}