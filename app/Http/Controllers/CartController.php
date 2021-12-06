<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;

class CartController extends Controller
{

    public function cart(Request $request)
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

    public function set(Request $request)
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

        if ($cart[$product_id] < 1) unset($cart[$product_id]);

        $response = new Response('Cart successfully updated!');
        $response->withCookie(cookie()->forever('cart', json_encode($cart)));
        return $response;
    }
}
