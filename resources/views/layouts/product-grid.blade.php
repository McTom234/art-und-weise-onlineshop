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
            <span>{{$product->getDiscountPriceEuro()}}</span>
        @endif
        <span>{{$product->getPriceEuro()}}</span>
        <a href="{{url("/product/{$product->id}")}}" class="link-button">Jetzt Bestellen</a>
    </div>
</article>