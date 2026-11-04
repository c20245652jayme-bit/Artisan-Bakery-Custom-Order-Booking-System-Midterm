
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('bakery_orders', function (Blueprint $table) {
            $table->id('order_id');

            $table->foreignId('customer_id')
                ->constrained('customers', 'customer_id');

            $table->foreignId('cake_product_id')
                ->constrained('cake_products', 'cake_product_id');

            $table->dateTime('pickup_datetime');
            $table->string('order_status')->default('pending');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bakery_orders');
    }
};
