<?php

namespace App\Http\Middleware;

use App\Models\Product;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;
use function Symfony\Component\Translation\t;

class CartMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next (\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        $cart = collect(json_decode($_COOKIE['cart'] ?? '[]', true));
        $cart = $cart->filter(fn($number, $product_id) => Product::find($product_id) != null);
        $cartCount = $cart->sum();

        if ($cartCount != 0) $cartCount = ' '.$cartCount;
        else $cartCount = '';

        View::share('cartCount', $cartCount);
        return $next($request)->withCookie(cookie()->forever('cart', $cart->toJson()));
    }
}
