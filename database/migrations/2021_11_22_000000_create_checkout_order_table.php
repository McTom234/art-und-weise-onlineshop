<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('checkout_order', function (Blueprint $table) {
            $table->unsignedInteger('id')->primary();
            $table->uuid('checkout_id')->index();
            $table->uuid('order_id')->index();

            $table->unique(['checkout_id', 'order_id']);
            $table->foreign('checkout_id')->references('id')->on('checkouts')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('order_id')->references('id')->on('orders')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('checkout_order');
    }
};
