@php
    /**
     * @var $attributes \Symfony\Component\HttpFoundation\Session\Attribute\AttributeBag
     * @var $product \App\Models\Product
     */

    $product = $attributes->get('product') ?? throw new HttpException("Produkt wurde nicht gefunden.", 404);
    $need_figure = $product->images()->first()
@endphp

<article class="{{ $need_figure ? '' : 'no-figure' }}">
    @if($need_figure)
        <figure>
            <a class="no-text-decoration" href="{{ url('/product', $product->id) }}">
                <img src="{{ $product->images()->first()->base64 }}" alt="{{ $product->name }}"/>
            </a>
        </figure>
    @endif
    <h3>
        <a class="no-text-decoration" href="{{ url('/product', $product->id) }}">{{ $product->name }}</a>
        @if ($product->contingent <= 0)
            <sub class="stock">nicht verfügbar</sub>
        @else
            <sub>noch {{ $product->contingent }} verfügbar</sub>
        @endif
    </h3>
    <p>
        <a class="no-text-decoration" href="{{ url('/product', $product->id) }}">{{ $product->description }}</a>
    </p>
    <div>
        <div class="item-control">
            <quantity data-id="{{ $product->id }}" data-number="{{ $product->number }}"></quantity>
            <button
                onclick="(async function() {setItem('{{ $product->id }}', 0, true).then(() => window.location.reload());})();">
                Löschen
            </button>
        </div>
        <price data-id="{{ $product->id }}"
               data-base-price="{{ $product->getDiscountPriceEuro() }}">{{ number_format($product->getDiscountPriceEuro()*$product->number, 2, ',', '.') }}</price>
    </div>
</article>
