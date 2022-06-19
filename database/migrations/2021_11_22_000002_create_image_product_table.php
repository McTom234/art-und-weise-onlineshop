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
        Schema::create('image_product', function (Blueprint $table) {
            $table->unsignedInteger('id')->autoIncrement();
            $table->uuid('image_id')->index();
            $table->uuid('product_id')->index();

            $table->unique(['image_id', 'product_id']);
            $table->foreign('image_id')->references('id')->on('images')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('product_id')->references('id')->on('products')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('image_product');
    }
};
