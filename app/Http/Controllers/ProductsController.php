<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(Request $request): Factory|View|Application|RedirectResponse
    {
        $request->validate([
            'q' => 'nullable|string|max:255'
        ]);

        $products = Product::query();
        $query = $request->get('q');

        if ($request->has('q'))
        {
            $products = $products->search($query);
        }
        $products = $products->paginate(15);

        return view('products.products', compact('products', 'query'));
    }

    public function productsForCategory(Request $request, Category $category): View|Factory|RedirectResponse|Application
    {
        $request->validate([
            'q' => 'nullable|string|max:255'
        ]);

        $products = $category->products()->getQuery();
        $query = $request->get('q');

        if ($request->has('q'))
        {
            $products = $products->search($query);
        }
        $products = $products->paginate(15);

        return view('products.products', compact('products', 'category', 'query'));
    }

    public function show(Product $product): Factory|View|Application
    {
        return view('products.product', ['product' => $product]);
    }
}
