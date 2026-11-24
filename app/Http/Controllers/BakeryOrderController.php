<?php

namespace App\Http\Controllers;

use App\Models\CakeProduct;
use App\Services\BakeryOrderService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BakeryOrderController extends Controller
{
    public function __construct(
        protected readonly BakeryOrderService $bakeryOrderService
    ) {}

    // Display the bakery order form
    public function create(): View
    {
        $cakes = CakeProduct::query()
            ->orderBy('cake_flavor')
            ->orderBy('cake_size')
            ->get(['cake_product_id', 'cake_flavor', 'cake_size', 'base_price']);

        return view('bakery.order-form', compact('cakes'));
    }

    // Save customer order
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'contact_phone' => 'required|string|max:20',
            'cake_product_id' => 'required|exists:cake_products,cake_product_id',
            'custom_inscription' => 'nullable|string|max:255',
            'add_on_decorations' => 'nullable|string|max:255',
            'add_on_price' => 'nullable|numeric|min:0',
            'total_deposit' => 'required|numeric|min:0',
            'payment_method' => 'required|string|max:50',
            'pickup_datetime' => 'required|date|after:now',
        ]);

        $this->bakeryOrderService->createOrder($validated);

        return redirect()
            ->route('bakery.order.create')
            ->with('success', 'Your bakery order has been submitted successfully!');
    }
}
