<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use App\Models\Order;
use App\Models\Product;
use Auth;
use Cookie;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CheckoutController extends Controller
{
    public function details(): Application|Factory|View|RedirectResponse
    {
        $userLocation = Auth::user()->location;

        if (request()->cookie('cart') !== null) {
            $shoppingCart = collect(json_decode(request()->cookie('cart'), true));
            $totalPrice = 0;

            foreach ($shoppingCart as $product_ID => $quantity) {
                $product = Product::findOrFail($product_ID);
                $product->quantity = $quantity;
                $totalPrice += $product->getDiscountPriceEuro() * $quantity;
                $shoppingCart->put($product_ID, $product);
            }
            if(count($shoppingCart) <= 0){
                return redirect()->route('cart');
            }

            return view('checkout.details', compact('userLocation', 'shoppingCart', 'totalPrice'));
        }
        else {
            return redirect()->route('products.index');
        }
    }

    public function success(): Factory|View|Application
    {
        $checkout = Checkout::create(['user_id' => Auth::id()]);
        if (!$checkout->save()) abort(500);

        $shoppingCart = collect(json_decode(request()->cookie('cart'), true));
        $aOrders = collect();
        foreach ($shoppingCart as $product_ID => $quantity) {
            $product = Product::findOrFail($product_ID);
            $order = Order::create(['price' => $product->price, 'discount' => $product->discount, 'quantity' => $quantity, 'product_id' => $product->id, 'checkout_id' => $checkout->id]);
            if (!$order->save()) {

            }
        }

        $aSavedOrders = collect();
        $fRollbackSavedOrders = function () use ($aSavedOrders) {
            foreach ($aSavedOrders as $order) {
                $order->delete();
            }
        };
        foreach ($aOrders as $order) {
            if (!$order->save()) {
                $fRollbackSavedOrders();
                abort(500);
            }
            $aSavedOrders->add($order);
        }

        Cookie::queue(Cookie::forever('cart', json_encode([])));

        return view('checkout.success');
    }
}
