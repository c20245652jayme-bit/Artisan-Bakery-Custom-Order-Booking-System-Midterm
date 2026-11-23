<?php

use App\Http\Controllers\BakeryOrderController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', [BakeryOrderController::class, 'create'])
    ->name('bakery.order.create');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

Route::post('/order', [BakeryOrderController::class, 'store'])
    ->name('bakery.order.store');
