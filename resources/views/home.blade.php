<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Schülerfirma Art und Weise</title>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>

<body>
<header>
    <div>
        <h4>Schülerfirma</h4>

        <h1>Art & Weise</h1>
    </div>

    <a href="#navbar">Mehr Erfahren!</a>
</header>
@include('layouts.navigation', ['index' => 'home'])
<main>
    <section>
        <div class="intro">
            <h3>Beliebte Produkte</h3>
            <p>Eine Auswahl unserer beliebtesten Produkte aus unserem Onlineshop.</p>
        </div>

        <a class="link-button more-items" href="/products">Weitere</a>
    </section>

    @foreach($categories as $category)
        <section>
            <div class="intro">
                <h3>{{$category->name}}</h3>
                <p>Eine Auswahl von Produkten aus der Kategorie {{$category->name}}.</p>
            </div>
            <div class="grid-container">
                @foreach($category->products()->take(3)->get() as $product)
                    @include('layouts.product')
                @endforeach
            </div>
            <a class="link-button more-items" href="{{route('products', ['category_id' => $category->id])}}">Weitere</a>
        </section>
    @endforeach
</main>
@include('layouts.footer')
</body>
</html>
