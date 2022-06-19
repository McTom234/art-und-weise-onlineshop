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
        $cart = collect(json_decode($_COOKIE['cart'] ?? '[]', true));
        $products = collect();
        foreach ($cart as $product_id => $number) {
            if ($product = Product::find($product_id)) {
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

        if (Product::find($product_id) == null)
            return response()->setStatusCode(404)->json(json_encode(['error' => "product with id: `$product_id` not found"]))->withCookie(cookie()->forever('cart', $cart->toJson()));

        if ($request->has('additional') && $request->get('additional')) {
            $product_number += $cart->get($product_id, 0);
        }
        $cart->put($product_id, $product_number);

        $cart = $cart->filter(fn($item) => $item > 0);

        return response()->json($cart->toJson())->withCookie(cookie()->forever('cart', $cart->toJson()));
    }
}
