@php
    // $need_figure = $product->images()->first()
    $need_figure = true;
@endphp
<article class="{{$need_figure ? '' : 'no-figure'}}">
    @if($need_figure)
        <figure>
            <a>
                <img/>
            </a>
        </figure>
    @endif
    <h3>
        <a></a>
    </h3>
    <p>
        <a></a>
    </p>
    <div>
        <div class="item-control">
            <div id="quantitySelect-wrapper"></div>
            <button></button>
        </div>
        <span></span>
    </div>
</article>
