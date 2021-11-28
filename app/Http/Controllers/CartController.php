<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cart()
    {
        $categories = Category::all();
        return view('cart', ['categories' => $categories]);
    }


    public function fetchCart(Request $request)
    {
        $request->validate([
            'cart' => 'string|required'
        ]);

        $cart = json_decode($request->cart, true);
        $products = [];
        foreach ($cart as $id => $count) {
            $product = Product::query()->find($id)->first();
            if (!$product) {
                array_push($items, false);
                continue;
            }
            array_push($products, $product);
        }
        return json_encode($products);
    }
}
