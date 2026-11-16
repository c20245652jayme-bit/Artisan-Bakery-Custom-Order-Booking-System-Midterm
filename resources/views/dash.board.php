<?php

use Illuminate\Support\Facades\Route;
use App\Models\Customer;
use App\Models\CakeProduct;
use App\Models\BakeryOrder;
use App\Models\OrderPayment;

Route::get('/dashboard', function () {

    $totalCustomers = Customer::count();
    $totalCakes = CakeProduct::count();
    $totalOrders = BakeryOrder::count();
    $totalPayments = OrderPayment::count();

    $recentOrders = BakeryOrder::with([
        'customer',
        'cakeProduct'
    ])->latest('order_id')->take(5)->get();

    $upcomingPickups = BakeryOrder::with([
        'customer',
        'cakeProduct'
    ])
    ->where('pickup_datetime', '>=', now())
    ->orderBy('pickup_datetime')
    ->take(5)
    ->get();

    return view('dashboard', compact(
        'totalCustomers',
        'totalCakes',
        'totalOrders',
        'totalPayments',
        'recentOrders',
        'upcomingPickups'
    ));

})->name('dashboard');
