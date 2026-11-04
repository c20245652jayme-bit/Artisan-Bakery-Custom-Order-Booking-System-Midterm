<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BakeryOrderController;

Route::get('/', [BakeryOrderController::class, 'create'])
    ->name('bakery.order.create');

Route::post('/order', [BakeryOrderController::class, 'store'])
    ->name('bakery.order.store');