<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('order_payments', function (Blueprint $table) {
            $table->id('payment_id');

            $table->foreignId('order_id')
                ->unique()
                ->constrained('bakery_orders', 'order_id');

            $table->decimal('total_deposit', 10, 2);
            $table->decimal('balance_due', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_payments');
    }
};