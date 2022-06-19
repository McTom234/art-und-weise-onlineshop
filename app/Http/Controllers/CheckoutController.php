<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class CheckoutController extends Controller
{
    public function details(): Factory|View|Application
    {
        return view('checkout.details');
    }

    public function success(): Factory|View|Application
    {
        return view('checkout.success');
    }
}
