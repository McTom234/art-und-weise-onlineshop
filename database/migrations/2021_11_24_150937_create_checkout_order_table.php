<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckoutOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkout_order', function (Blueprint $table) {
            $table->foreignUuid('checkout_id')->constrained('checkouts')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignUuid('order_id')->constrained('orders')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('checkout_order');
    }
}
