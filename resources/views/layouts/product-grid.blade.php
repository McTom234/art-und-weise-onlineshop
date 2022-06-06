<article class="grid-column--4">
    <a class="no-text-decoration" href="{{url("/product/{$product->id}")}}">
        <figure @if ($product->images()->first())
                    style="background-image: url('{{$product->images()->first()->base64}}')"
            @endif></figure>
    </a>

    <h4>
        <a class="no-text-decoration" href="{{url("/product/{$product->id}")}}">{{$product->name}}</a>
    </h4>

    <p>
        <a class="no-text-decoration" href="{{url("/product/{$product->id}")}}">{{$product->description}}</a>
    </p>

    <div class="price">
        @if ($product->discount > 0)
            <span>{{number_format($product->getDiscountPriceEuro(), 2, ',', '.')}}</span>
        @endif
        @if ($product->contingent <= 0)
            <i class="stock">nicht verfügbar</i>
        @else
            <i>noch {{$product->contingent}} verfügbar</i>
        @endif
        <span>{{number_format($product->getPriceEuro(), 2, ',', '.')}}</span>
        <a href="{{url("/product/{$product->id}")}}" class="link-button">Jetzt Bestellen</a>
    </div>
</article>
