<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function details(){
        return view('checkout.details');
    }

    public function success(){
        return view('checkout.success');
    }
}
