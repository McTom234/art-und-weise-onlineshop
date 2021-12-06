@php
    $need_figure = $product->images()->first()
@endphp
<article class="{{$need_figure ? '' : 'no-figure'}}">
    @if($need_figure)
        <figure>
            <a class="no-text-decoration" href="{{url('/product', $product->id)}}">
                <img src="{{$product->images()->first()->base64}}" alt="{{$product->name}}"/>
            </a>
        </figure>
    @endif
    <h3>
        <a class="no-text-decoration" href="{{url('/product', $product->id)}}">{{$product->name}}</a>
    </h3>
    <p>
        <a class="no-text-decoration" href="{{url('/product', $product->id)}}">{{$product->description}}</a>
    </p>
    <div>
        <div class="item-control">
            <quantity data-id="{{$product->id}}" data-number="{{$product->number}}"></quantity>
            <button onclick="(async function(){ await deleteItem({{$product->id}}); window.location.reload(true); }) ();">Löschen</button>
        </div>
        <span data-id="{{$product->id}}">{{number_format($product->getDiscountPriceEuro()*$product->number, 2, ',', '.')}}</span>
    </div>
</article>
