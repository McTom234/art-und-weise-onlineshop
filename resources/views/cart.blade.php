<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Schülerfirma Art und Weise | Warenkorb</title>
    <link rel="stylesheet" href="{{asset('css/shoppingCart.css')}}">

    <script src="{{asset('js/shoppingCart.js')}}"></script>
    <script src="{{asset('js/quantitySelect.js')}}"></script>
</head>

<body>
@include('layouts.navigation', ['index' => 'cart'])

<main>
    <section id="cart-list">
        <h2>Warenkorb</h2>
    </section>

    @each('layouts.cart-product', $products, 'product')
    <a href="{{route('checkout.details')}}" id="buy-button" class="link-button">Kaufen</a>
</main>

@include('layouts.footer')
</body>
</html>
