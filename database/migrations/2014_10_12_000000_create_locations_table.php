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
        Schema::create('locations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('street');
            $table->string('street_number');
            $table->integer('postcode');
            $table->string('city');
            $table->timestamps();

            $table->unique(['city', 'postcode', 'street', 'street_number']);
            $table->index(['city', 'postcode', 'street', 'street_number']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
