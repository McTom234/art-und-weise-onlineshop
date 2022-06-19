@extends('layouts.master')

@section('head-scripts')
    <link rel="stylesheet" href="{{asset('css/shoppingCart.css')}}">
@endsection

@section('content')
    <section id="cart-list">
        <h2>Warenkorb</h2>
        @each('layouts.product-list', $products, 'product')
    </section>

    @if($products->count() > 0)
        <a href="{{route('checkout.details')}}" id="buy-button" class="link-button">Kaufen</a>
    @endif
@endsection

@section('foot-scripts')
    <script src="{{asset('js/shoppingCart.js')}}"></script>
    <script src="{{asset('js/quantitySelect.js')}}"></script>
    <script>
        // todo exclude
        const wrappers = document.getElementsByTagName("quantity");
        const priceTags = document.getElementsByTagName("price");
        for (let i = 0; i < wrappers.length; i++) {
            const wrapper = wrappers.item(i);
            wrapper.append(
                createQuantitySelect(Number(wrapper.attributes.getNamedItem("data-number").nodeValue), [1, 2, 3, 4, 5], 100, true, async function (number) {
                    // todo total price span with custom tag and data- attributes
                    const priceTag = getPriceTag(wrapper.attributes.getNamedItem("data-id").nodeValue);
                    priceTag.textContent = (priceTag.attributes.getNamedItem("data-base-price").nodeValue * number).toFixed(2).toString().replace(".", ",");

                    setItem(Number(wrapper.attributes.getNamedItem("data-id").nodeValue), number).then(res => {
                        const cart = res.data;
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
@endsection
