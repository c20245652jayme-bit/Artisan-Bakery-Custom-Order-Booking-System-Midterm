<?php

namespace App\Http\Controllers;

use App\Models\BakeryOrder;
use App\Models\CakeProduct;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('welcome', [
            'totalOrders' => BakeryOrder::query()->count(),
            'ordersToday' => BakeryOrder::query()->whereDate('created_at', today())->count(),
            'pendingOrders' => BakeryOrder::query()->where('order_status', 'pending')->count(),
            'cakeProducts' => CakeProduct::query()->count(),
            'recentOrders' => BakeryOrder::query()
                ->with('cakeProduct:cake_product_id,cake_flavor,cake_size')
                ->latest('created_at')
                ->limit(5)
                ->get(),
        ]);
    }
}
