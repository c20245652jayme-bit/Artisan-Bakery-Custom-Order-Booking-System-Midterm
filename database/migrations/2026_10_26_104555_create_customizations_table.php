
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('customizations', function (Blueprint $table) {
            $table->id('customization_id');

            $table->unsignedBigInteger('order_id')->unique();

            $table->string('custom_inscription')->nullable();
            $table->string('add_on_decorations')->nullable();
            $table->decimal('add_on_price', 10, 2)->default(0);

            $table->timestamps();

            $table->foreign('order_id')
                ->references('order_id')
                ->on('bakery_orders')
                ->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('customizations');
    }
};
