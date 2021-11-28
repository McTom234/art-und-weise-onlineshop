<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schülerfirma Art und Weise | Warenkorb</title>
    <link rel="stylesheet" href="{{asset('css/shoppingCart.css')}}">
</head>

<body>
@include('layouts.navigation', ['index' => 'cart'])

<main>
    <section id="cart-list">
        <h2>Warenkorb</h2>
    </section>
    <a href="{{route('checkout.details')}}" id="buy-button" class="link-button">Kaufen</a>
</main>

@include('layouts.footer')

<script src="{{asset('js/cookies.js')}}"></script>
<script src="{{asset('js/shoppingCart.js')}}"></script>
<script src="{{asset('js/quantitySelect.js')}}"></script>
<script src="{{asset('js/renderShoppingCart.js')}}"></script>
</body>

</html>
