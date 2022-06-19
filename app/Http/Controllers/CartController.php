<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Renders the view with products in cart.
     *
     * @return Factory|View|Application
     */
    public function getCartView(): Factory|View|Application
    {
        if (isset($_COOKIE['cart'])) {
            $cart = json_decode($_COOKIE['cart'], true);
        } else {
            $cart = [];
        }
        $products = collect();
        foreach ($cart as $product_id => $number) {
            $product = Product::find($product_id);
            if ($product) {
                $product->number = $number;
                $products->add($product);
            }
        }
        return view('cart', compact('products'));
    }

    public function set(Request $request): JsonResponse
    {
        $request->validate([
            'id' => 'string|required',
            'number' => 'numeric|required',
        ]);

        if (isset($_COOKIE['cart'])) {
            $cart = collect(json_decode($_COOKIE['cart'], true));
        } else {
            $cart = collect();
        }
        $product_id = $request->get('id');
        $product_number = $request->get('number');

        if ($request->has('additional') && $request->get('additional')) {
            $product_number += $cart->value($product_id, 0);
        }
        $cart->put($product_id, $product_number);

        $cart = $cart->filter(fn($item) => $item > 0);

        return response()->json($cart->toJson())->withCookie(cookie()->forever('cart', $cart->toJson()));
    }
}
