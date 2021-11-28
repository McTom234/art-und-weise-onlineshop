<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Route;

class ProdcutsController extends Controller
{
    public function products(Request $request, $category_id = null)
    {
        $request->validate([
            'p' => 'numeric',
            'q' => 'nullable|string|max:255'
        ]);
        $page = $request->has('p') ? $request->p : 1;
        $query = $request->has('q') ? $request->q : '';
        $limit = 15;

        $categories = Category::all();
        $category = null;
        $products = null;
        $productsCount = 0;

        if ($category_id && !$query) {
            $category = Category::query()->find($category_id);
            if ($category) {

                $products = $category->products()->forPage($page, $limit)->get();
            }
        } else {
            $productsQuery = Product::query()->where('name', 'LIKE', "%{$query}%")->orWhere('description', 'LIKE', "%{$query}%");
            $productsCount = $productsQuery->count();
            $products = $productsQuery->forPage($page, $limit)->get();
        }

        $maxPages = ceil($productsCount / $limit);

        $routePage = function ($page) use ($request) {
            $route = $request->route();
            $parameters = $route->parameters();
            $parameters['p'] = $page > 1 ? $page : null;
            return route($route->getName(), $parameters);
        };

        $search = function ($query) use ($request){
            $route = $request->route();
            $parameters = ['q' => $query > 1 ? $query : null];
            return route($route->getName(), $parameters);
        };

        return view('products', ['categories' => $categories, 'products' => $products, 'category' => $category, 'page' => $page, 'query' => $query, 'maxPages' => $maxPages, 'routePage' => $routePage, 'search' => $search]);
    }

    public function product(Product $product){
        $categories = Category::all();
        return view('product', ['categories' => $categories, 'product' => $product]);
    }
}
