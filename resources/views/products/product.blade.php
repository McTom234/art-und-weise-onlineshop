@extends('layouts.master')

@section('head-scripts')
    <link rel="stylesheet" href="{{ asset('css/product.css') }}">
@endsection

@section('body-before-content')
    <div id="popup" class="popup">
        <a href="#" class="popup"></a>
        <div class="popup-box">
            <a class="popup-cancel no-text-decoration" href="#">×</a>

            <div class="popup-title"><strong>{{ $product->name }}</strong> wurde zum Warenkorb hinzugefügt</div>

            <div class="popup-content">
                <p>Preis: <span id="popup-price"></span> €</p>

                <p>Anzahl: <span id="popup-count"></span></p>

                <p>Gesamt: <span id="popup-result"></span> €</p>
            </div>

            <div class="popup-bottom">
                <a href="{{ route('cart') }}" class="link-button">Zum Warenkorb</a>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <article>
        @if($product->images()->first())
            <figure>
                <img src="{{ $product->images()->first()->base64 }}" class="item_image" alt="{{ $product->name }}"/>
            </figure>

            <div>
        @else
            <div class="no-figure">
        @endif

            <h4>{{ $product->name }}</h4>
            @foreach($product->categories()->get() as $category)
                <p><a href="{{ route('products.category', $category->id) }}">{{ $category->name }}</a></p>
            @endforeach
            <p>{{ $product->description }}</p>
        </div>

        <aside>
            @if ($product->discount > 0 && (number_format($product->getDiscountPriceEuro(), 2, ',', '.') !== number_format($product->getPriceEuro(), 2, ',', '.')))
                <span>{{ number_format($product->getDiscountPriceEuro(), 2, ',', '.') }}</span>
                <span>{{ number_format($product->getPriceEuro(), 2, ',', '.') }}</span>
            @else
                <span style="grid-column: 2;">{{ number_format($product->getPriceEuro(), 2, ',', '.') }}</span>
            @endif
            <a href="#popup" id="addToCartButton" class="link-button">In den Einkaufswagen</a>
            <button class="inactive" id="buyButton">Jetzt kaufen</button>
            <div id="quantitySelect-wrapper"></div>
            <p id="price">{{ number_format($product->getDiscountPriceEuro(), 2, ',', '.') }}</p>
            <div class="supplement">
                @if ($product->contingent <= 0)
                    <i class="stock">nicht verfügbar</i>
                @else
                    <i>noch {{ $product->contingent }} verfügbar</i>
                @endif
                <i>zzgl. Versandkosten</i>
            </div>
        </aside>
    </article>
@endsection

@section('foot-scripts')
    <script src="{{ asset('js/shoppingCart.js') }}"></script>
    <script src="{{ asset('js/quantitySelect.js') }}"></script>
    <script>
        // todo include dynamic navbar counter changes
        const values = [
            1, 2, 3, 4, 5
        ]
        let currentValue = 1;
        document.getElementById('quantitySelect-wrapper').appendChild(
            createQuantitySelect(currentValue, values, 100, true, function (number) {
                let price = document.getElementById('price');
                price.textContent = ({{ $product->getDiscountPriceEuro() }} * number).toFixed(2).toString().replace(".", ",");
                currentValue = number;
            })
        );

        document.getElementById('addToCartButton').addEventListener('click', async function () {
            setItem("{{ $product->id }}", currentValue, true).then(() => openPopup());
        });

        function openPopup() {
            let count = document.getElementById('popup-count');
            count.textContent = currentValue.toString().replace(".", ",");
            let price = document.getElementById('popup-price');
            price.textContent = {{ $product->getDiscountPriceEuro() }};
            let result = document.getElementById('popup-result');
            result.textContent = (currentValue * {{ $product->getDiscountPriceEuro() }}).toFixed(2).toString().replace(".", ",");
        }

        // TODO: implement buy button
    </script>
@endsection
