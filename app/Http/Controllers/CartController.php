<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CartController extends Controller
{

    public function cart(): Factory|View|Application
    {
        if (isset($_COOKIE['cart'])) {
            $cart = json_decode($_COOKIE['cart'], true);
        } else {
            $cart = [];
        }
        $products = [];
        foreach ($cart as $product_id => $number) {
            $product = Product::query()->find($product_id);
            if ($product) {
                $product->number = $number;
                array_push($products, $product);
            }
        }
        return view('cart', ['products' => $products]);
    }

    public function set(Request $request): Response
    {
        $request->validate([
            'id' => 'string|required',
            'number' => 'numeric|required',
        ]);

        if (isset($_COOKIE['cart'])) {
            $cart = json_decode($_COOKIE['cart'], true);
        } else {
            $cart = [];
        }
        $product_id = $request->id;
        $product_number = $request->number;

        if ($request->additional) {
            $old_product_number = $cart[$product_id] ?? 0;
            $cart[$product_id] = $old_product_number + $product_number;
        } else {
            $cart[$product_id] = $product_number;
        }

        for ($i = 0; $i < count($cart); $i++) if (array_values($cart)[$i] <= 0) array_splice($cart, $i, 1);

        $response = new Response(json_encode($cart));
        $response->withCookie(cookie()->forever('cart', json_encode($cart)));

        return $response;
    }
}
