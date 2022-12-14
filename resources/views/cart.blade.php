@extends('layouts.master')

@section('head-scripts')
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
@endsection

@section('content')
    <section id="cart-list">
        <h2>Warenkorb</h2>
        @foreach($products as $product)
            <x-product-list :product="$product"></x-product-list>
        @endforeach
    </section>

    @if($products->count() > 0)
        <a href="{{ route('checkout.details') }}" id="buy-button" class="link-button">Kaufen</a>
    @else
        <p>Der Warenkorb ist leer.</p>
    @endif
@endsection

@section('foot-scripts')
    <script src="{{ asset('js/shoppingCart.js') }}"></script>
    <script src="{{ asset('js/quantitySelect.js') }}"></script>
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

                    setItem(wrapper.attributes.getNamedItem("data-id").nodeValue, number).then();
                })
            );
        }

        function getPriceTag(id) {
            for (let i = 0; i < priceTags.length; i++) {
                if (priceTags.item(i).attributes.getNamedItem("data-id").nodeValue === id) return priceTags.item(i);
            }
        }
    </script>
@endsection
