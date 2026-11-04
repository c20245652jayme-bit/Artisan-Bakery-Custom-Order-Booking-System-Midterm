
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::table('customizations', function (Blueprint $table) {
            $table->unsignedBigInteger('order_id')->nullable();
        });

        DB::statement("
            UPDATE customizations AS c
            INNER JOIN bakery_orders AS o
                ON o.customization_id = c.customization_id
            SET c.order_id = o.order_id
        ");

        Schema::table('bakery_orders', function (Blueprint $table) {
            $table->dropForeign(['customization_id']);
            $table->dropColumn('customization_id');
        });

        Schema::table('customizations', function (Blueprint $table) {
            $table->dropForeign(['cake_product_id']);
            $table->dropColumn('cake_product_id');
        })
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
