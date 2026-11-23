<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('customizations', function (Blueprint $table) {
            $table->unsignedBigInteger('order_id')->nullable();
        });
        Schema::table('customizations', function (Blueprint $table) {
            $table->unique('order_id');

            $table->foreign('order_id')
                ->references('order_id')
                ->on('bakery_orders')
                ->cascadeOnDelete();
        });
    }

    public function down()
    {
        throw new \RuntimeException(
            'Restore the database backup to reverse this migration safely.'
        );
    }
};
