<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProdcutsController;
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

Route::get('/', [Controller::class, 'home'])->name('home');
Route::get('/about', [Controller::class, 'about'])->name('about');

Route::get('/products/{category_id?}', [ProdcutsController::class, 'products'])->name('products');
Route::get('/product/{product}', [ProdcutsController::class, 'product'])->name('product');

Route::get('/cart', [CartController::class, 'cart'])->name('cart');

Route::name('checkout.')->middleware(['auth'])->group(function () {
    Route::get('/details', [CheckoutController::class, 'details'])->name('details');
    Route::get('/success', [CheckoutController::class, 'success'])->name('success');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
