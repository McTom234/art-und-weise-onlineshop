<?php

use App\Http\Controllers\CartController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('cart')->group(function () {
    Route::post('/set', [CartController::class, 'set'])
        ->name('api.cart.set');
});


