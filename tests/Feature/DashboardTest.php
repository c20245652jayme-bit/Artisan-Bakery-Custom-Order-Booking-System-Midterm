<?php

namespace Tests\Feature;

use App\Models\BakeryOrder;
use App\Models\CakeProduct;
use App\Models\Customer;
use App\Services\BakeryOrderService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_bakery_order_service_is_registered_as_a_singleton(): void
    {
        $first = app(BakeryOrderService::class);
        $second = app(BakeryOrderService::class);

        $this->assertSame($first, $second);
    }

    public function test_dashboard_displays_aggregate_order_stats_without_customer_details(): void
    {
        $customer = Customer::create([
            'customer_name' => 'Private Customer',
            'contact_phone' => '09123456789',
        ]);
        $cake = CakeProduct::create([
            'cake_flavor' => 'Chocolate',
            'cake_size' => 'Medium',
            'base_price' => 1200,
        ]);

        BakeryOrder::create([
            'customer_id' => $customer->customer_id,
            'cake_product_id' => $cake->cake_product_id,
            'pickup_datetime' => now()->addDay(),
            'order_status' => 'pending',
        ]);
        BakeryOrder::create([
            'customer_id' => $customer->customer_id,
            'cake_product_id' => $cake->cake_product_id,
            'pickup_datetime' => now()->addDays(2),
            'order_status' => 'completed',
        ]);

        $response = $this->get(route('dashboard'));

        $response->assertOk()
            ->assertViewIs('welcome')
            ->assertViewHas('totalOrders', 2)
            ->assertViewHas('ordersToday', 2)
            ->assertViewHas('pendingOrders', 1)
            ->assertViewHas('cakeProducts', 1)
            ->assertSee(route('bakery.order.create'))
            ->assertSee('Recent orders')
            ->assertSee('Chocolate · Medium')
            ->assertSee('pending')
            ->assertSee('completed')
            ->assertDontSee('Private Customer')
            ->assertDontSee('09123456789');
    }
}
