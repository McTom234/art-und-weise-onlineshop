<article>
    <a href="{{url('/product', $product->id)}}">
        <img src="{{$product->images()->first()->base64}}" alt="{{$product->name}}">
    </a>
    <h3>{{$product->name}}</h3>
    <p>{{$product->getShortDescription()}}</p>
    <p id="total-price"><span>{{$product->getDiscountPriceEuro() * $product->number}}</span> €</p>
    <p id="quantitySelect-wrapper-{{$product->id}}"></p>
</article>

<script>
    document.getElementById('quantitySelect-wrapper-{{$product->id}}').appendChild(
        createQuantitySelect({{$product->number}}, [1, 2, 3, 4, 5], 100, true, function (number) {
            let price = document.getElementById('total-price');
            price.textContent = ({{$product->getDiscountPriceEuro()}} * number).toFixed(2).toString().replace(".", ",");
            setItem("{{$product->id}}", number, 0)
        })
    );
</script>

