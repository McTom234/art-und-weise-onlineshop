<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Schülerfirma Art und Weise | Produktübersicht</title>
    <link rel="stylesheet" href="{{asset('css/products-overview.css')}}">
</head>

<body>
@include('layouts.navigation', ['index' => $category->id ?? 'products'])

<main>
    @isset($category)
        <h2>{{$category->name}}</h2>
    @endisset

    @include('layouts.searchbar')

    @if(count($products) > 0)
        <div class="grid-container">
            @foreach($products as $product)
                @include('layouts.product-grid')
            @endforeach
        </div>
    @else
        <p class="product-not-found">Es wurden keine Produkte gefunden.</p>
    @endif

    @include('layouts.page-navigation')
</main>
@include('layouts.footer')
</body>

</html>

