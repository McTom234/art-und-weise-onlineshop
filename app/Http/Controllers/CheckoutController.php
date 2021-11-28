<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function details(){
        $categories = Category::all();
        return view('checkout.details' , ['categories' => $categories]);
    }

    public function success(){
        $categories = Category::all();
        return view('checkout.success' , ['categories' => $categories]);
    }
}
