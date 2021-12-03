<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Schülerfirma Art und Weise | {{$product->name}}</title>
    <link rel="stylesheet" href="{{asset('css/showProduct.css')}}">
</head>

<body>
<div id="popup" class="popup">
    <a href="#" class="popup"></a>
    <div class="popup-box">
        <a class="popup-cancel no-text-decoration" href="#">×</a>

        <div class="popup-title"><strong>{{$product->name}}</strong> wurde zum Warenkorb hinzugefügt</div>

        <div class="popup-content">
            <p>Preis: <span id="popup-price"></span> €</p>

            <p>Anzahl: <span id="popup-count"></span></p>

            <p>Gesamt: <span id="popup-result"></span> €</p>
        </div>

        <div class="popup-bottom">
            <a href="{{route('cart')}}" class="link-button">Zum Warenkorb</a>
        </div>
    </div>
</div>

@include('layouts.navigation', ['index' => 'products'])

<main>
    <article>
        <figure>
            <img src="{{$product->images()->first()->base64}}" class="item_image" alt="{{$product->name}}"/>
        </figure>

        <div>
            <h4>{{$product->name}}</h4>
            @foreach($product->categories()->get() as $category)
                <p><a href="{{url("products/{$category->id}")}}">{{$category->name}}</a></p>
            @endforeach
            <p>{{$product->description}}</p>
        </div>

        <aside>
            @if ($product->discount > 0)
                <span>{{$product->getDiscountPriceEuro()}}</span>
            @endif
            <span>{{$product->getPriceEuro()}}</span>
            <a href="#popup" id="addToCartButton" class="link-button">In den Einkaufswagen</a>
            <button class="inactive" id="buyButton">Jetzt kaufen</button>
            <div id="quantitySelect-wrapper"></div>
            <div id="total-price"></div>
        </aside>
    </article>
</main>

@include('layouts.footer')

<script src="{{asset('js/cookies.js')}}"></script>
<script src="{{asset('js/shoppingCart.js')}}"></script>
<script src="{{asset('js/quantitySelect.js')}}"></script>
<script>
    const values = [
        1, 2, 3, 4, 5
    ]
    let currentValue = 1;
    document.getElementById('quantitySelect-wrapper').appendChild(
        createQuantitySelect(currentValue, values, 100, true, function (number) {
            let price = document.getElementById('total-price');
            price.textContent = ({{$product->getDiscountPriceEuro()}} * number).toFixed(2).toString().replace(".", ",");
            currentValue = number;
        })
    );

    document.getElementById('addToCartButton').addEventListener('click', function () {
        setItem("{{$product->id}}", currentValue)
        openPopup();
    });

    function openPopup() {
        let count = document.getElementById('popup-count');
        count.textContent = currentValue.toString().replace(".", ",");
        let price = document.getElementById('popup-price');
        price.textContent = {{$product->getDiscountPriceEuro()}};
        let result = document.getElementById('popup-result');
        result.textContent = (currentValue * {{$product->getDiscountPriceEuro()}}).toFixed(2).toString().replace(".", ",");
    }
</script>
</body>

</html>
