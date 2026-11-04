<?php

namespace App\Services;

use App\Models\BakeryOrder;
use App\Models\CakeProduct;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class BakeryOrderService
{
    public function createOrder(array $data): BakeryOrder
    {
        Validator::make($data, [
            'customer_name' => 'required|string|max:100',
            'contact_phone' => 'required|string|max:20',
            'cake_product_id' => 'required|exists:cake_products,cake_product_id',
            'pickup_datetime' => 'required|date',
            'custom_inscription' => 'nullable|string|max:255',
            'add_on_decorations' => 'nullable|string|max:255',
            'add_on_price' => 'nullable|numeric|min:0',
            'total_deposit' => 'required|numeric|min:0',
            'payment_method' => 'required|string|max:50',
        ])->validate();

        $phone = preg_replace(
            '/[^0-9+]/',
            '',
            trim($data['contact_phone'])
        );

        if ($phone === '' || strlen($phone) > 20) {
            throw ValidationException::withMessages([
                'contact_phone' => 'Enter a valid phone number.',
            ]);
        }

        $cake = CakeProduct::findOrFail(
            $data['cake_product_id']
        );

        $basePrice = (float) $cake->base_price;
        $addOnPrice = (float) ($data['add_on_price'] ?? 0);
        $deposit = (float) $data['total_deposit'];

        $totalPrice = $basePrice + $addOnPrice;

        if ($deposit < $totalPrice * 0.50) {
            throw ValidationException::withMessages([
                'total_deposit' => 'Deposit must be at least 50%.',
            ]);
        }

        if ($deposit > $totalPrice) {
            throw ValidationException::withMessages([
                'total_deposit' => 'Deposit cannot exceed the total price.',
            ]);
        }

        $balance = round($totalPrice - $deposit, 2);

        return DB::transaction(function () use (
            $data,
            $phone,
            $cake,
            $addOnPrice,
            $deposit,
            $balance
        ) {
            $customer = Customer::create([
                'customer_name' => trim($data['customer_name']),
                'contact_phone' => $phone,
            ]);

            $order = BakeryOrder::create([
                'customer_id' => $customer->customer_id,
                'cake_product_id' => $cake->cake_product_id,
                'pickup_datetime' => $data['pickup_datetime'],
            ]);

            $order->customization()->create([
                'custom_inscription' => trim(
                    strip_tags($data['custom_inscription'] ?? '')
                ) ?: null,
                'add_on_decorations' => trim(
                    strip_tags($data['add_on_decorations'] ?? '')
                ) ?: null,
                'add_on_price' => $addOnPrice,
            ]);

            $order->payment()->create([
                'payment_amount' => $deposit,
                'payment_date' => now()->toDateString(),
                'payment_method' => $data['payment_method'],
                'total_deposit' => $deposit,
                'balance_due' => $balance,
            ]);

            return $order;
        });
    }
}
