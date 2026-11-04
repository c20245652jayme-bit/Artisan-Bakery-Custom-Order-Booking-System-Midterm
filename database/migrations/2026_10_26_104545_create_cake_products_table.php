<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('cake_products', function (Blueprint $table) {
            $table->id('cake_product_id');
            $table->string('cake_flavor');
            $table->string('cake_size');
            $table->decimal('base_price', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cake_products');
    }
};
