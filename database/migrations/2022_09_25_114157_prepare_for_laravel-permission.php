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
    public function up()
    {
        Schema::table('locations', function (Blueprint $table) {
            $table->string('street', 255)->change();
            $table->string('city', 255)->change();
        });
        Schema::table('users', function (Blueprint $table) {
            $table->string('forename', 512)->change();
            $table->string('surname', 512)->change();
            $table->string('email', 512)->change();
            $table->string('password', 512)->change();
        });
        Schema::table('password_resets', function (Blueprint $table) {
            $table->string('email', 512)->change();
            $table->string('token', 512)->change();
        });
        Schema::table('failed_jobs', function (Blueprint $table) {
            $table->uuid()->change();
        });
        Schema::table('personal_access_tokens', function (Blueprint $table) {
            $table->string('name', 512)->change();
        });
        Schema::table('categories', function (Blueprint $table) {
            $table->string('name', 512)->change();
        });
        Schema::table('products', function (Blueprint $table) {
            $table->string('name', 512)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('locations', function (Blueprint $table) {
            $table->string('street')->change();
            $table->string('city')->change();
        });
        Schema::table('users', function (Blueprint $table) {
            $table->string('forename')->change();
            $table->string('surname')->change();
            $table->string('email')->change();
            $table->string('password')->change();
        });
        Schema::table('password_resets', function (Blueprint $table) {
            $table->string('email')->change();
            $table->string('token')->change();
        });
        Schema::table('failed_jobs', function (Blueprint $table) {
            $table->string('uuid')->change();
        });
        Schema::table('personal_access_tokens', function (Blueprint $table) {
            $table->string('name')->change();
        });
        Schema::table('categories', function (Blueprint $table) {
            $table->string('name')->change();
        });
        Schema::table('products', function (Blueprint $table) {
            $table->string('name')->change();
        });
    }
};
