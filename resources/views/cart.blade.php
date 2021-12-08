<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Schülerfirma Art und Weise | Warenkorb</title>
    <link rel="stylesheet" href="{{asset('css/shoppingCart.css')}}">
</head>

<body>
@include('layouts.navigation', ['index' => 'cart'])

<main>
    <section id="cart-list">
        <h2>Warenkorb</h2>
        @each('layouts.product-list', $products, 'product')
    </section>

    <a href="{{route('checkout.details')}}" id="buy-button" class="link-button">Kaufen</a>
</main>

@include('layouts.footer')

<script src="{{asset('js/shoppingCart.js')}}"></script>
<script src="{{asset('js/quantitySelect.js')}}"></script>
<script>
    // todo exclude
    const wrappers = document.getElementsByTagName("quantity");
    const priceTags = document.getElementsByTagName("price");
    for (let i = 0; i < wrappers.length; i++) {
        const wrapper = wrappers.item(i);
        wrapper.append(
            createQuantitySelect(wrapper.attributes.getNamedItem("data-number").nodeValue, [1, 2, 3, 4, 5], 100, true, async function (number) {
                // todo total price span with custom tag and data- attributes
                const priceTag = getPriceTag(wrapper.attributes.getNamedItem("data-id").nodeValue);
                priceTag.textContent = (priceTag.attributes.getNamedItem("data-base-price").nodeValue * number).toFixed(2).toString().replace(".", ",");

                await setItem(wrapper.attributes.getNamedItem("data-id").nodeValue, number, 0).then(value => {
                    const cart = JSON.parse(value);
                    // navbar
                    let count = 0;
                    for (const cartObject in cart) {
                        count += Number(cart[cartObject]);
                    }
                    setCartCount(count);
                });
            })
        );
    }

    function getPriceTag(id) {
        for (let i = 0; i < priceTags.length; i++) {
            if (priceTags.item(i).attributes.getNamedItem("data-id").nodeValue === id) return priceTags.item(i);
        }
    }

    function setCartCount(count) {
        if (count > 0) count = ' '+count;
        else count = '';
        document.getElementById('navbar-cart-counter').innerHTML = count;
    }
</script>
</body>
</html>
