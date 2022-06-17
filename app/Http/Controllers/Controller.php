<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function home(): Factory|View|Application
    {
        // TODO: DB seeding
        /**
        for ($i = 1; $i <= 4; $i++) {
            $category = new Category();
            $category->name = "Category " . $i;

            for ($i = 1; $i <= 5; $i++) {

                $image = new Image();

                $file_tmp = 'https://picsum.photos/200/300';
                $type = pathinfo($file_tmp, PATHINFO_EXTENSION);
                $data = file_get_contents($file_tmp);
                $image->base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

                $product = new Product();
                $product->name = 'Product ' . $i;
                $product->description = 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.';
                $product->price = rand(50, 2000);
                $product->contingent = 50;
                if (rand(0, 3) == 0) {
                    $product->discount = rand(0, 100);
                } else {
                    $product->discount = 0;
                }
                $product->save();
                $product->images()->save($image);
                $product->categories()->save($category);
            }
        } **/

        $categories = Category::all();
        return view('home' , ['categories' => $categories, 'popular' => Product::getPopularProducts()]);
    }

    public function about(): Factory|View|Application
    {
        return view('about');
    }
}
