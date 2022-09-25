<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

require __DIR__.'/auth.php';

Route::get('', [Controller::class, 'home'])
    ->name('index');

Route::get('about', [Controller::class, 'about'])
    ->name('about');

Route::prefix('products')->group(function () {
    Route::get('', [ProductsController::class, 'index'])
        ->name('products.index');

    Route::get('{product}', [ProductsController::class, 'show'])
        ->name('products.show');

    Route::get('category/{category}', [ProductsController::class, 'productsForCategory'])
        ->name('products.category');
});

Route::get('cart', [CartController::class, 'getCartView'])
    ->name('cart');

Route::prefix('checkout')->middleware(['auth'])->group(function () {
    Route::get('details', [CheckoutController::class, 'details'])
        ->name('checkout.details');
    Route::get('success', [CheckoutController::class, 'success'])
        ->name('checkout.success');
});
