<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BakeryOrderService;
use Illuminate\Validation\ValidationException;

class BakeryOrderController extends Controller
{
    protected $bakeryOrderService;

    public function __construct(BakeryOrderService $bakeryOrderService)
    {
        $this->bakeryOrderService = $bakeryOrderService;
    }

    // Display the bakery order form
    public function create()
{
    $cakes = \App\Models\CakeProduct::all();

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
            'pickup_datetime' => 'required|date|after:now',
        ]);

        try {
            $this->bakeryOrderService->createOrder($validated);

            return redirect()
                ->route('bakery.order.create')
                ->with('success', 'Your bakery order has been submitted successfully!');
        } catch (ValidationException $e) {
            throw $e;
        }
    }
}
