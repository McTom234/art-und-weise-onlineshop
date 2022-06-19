@extends('layouts.master')

@php
    /**
     * @var \Illuminate\Database\Eloquent\Collection $popular
     * @var \Illuminate\Database\Eloquent\Collection $categories
     * @var \App\Models\Product $product
     * @var \App\Models\Category $category
     */
@endphp

@section('head-scripts')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection

@section('header')
    <header>
        <div>
            <h4>Schülerfirma</h4>

            <h1>Art & Weise</h1>
        </div>

        <a href="#navbar">Mehr Erfahren!</a>
    </header>
@endsection

@section('content')
    <section>
        <div class="intro">
            <h3>Beliebte Produkte</h3>
            <p>Eine Auswahl unserer beliebtesten Produkte aus unserem Onlineshop.</p>
        </div>
        <div class="grid-container">
            @foreach($popular as $product)
                <x-product-grid :product="$product"></x-product-grid>
            @endforeach
        </div>
    </section>

    @foreach($categories as $category)
        <section>
            <div class="intro">
                <h3>{{ $category->name }}</h3>
                <p>Eine Auswahl von Produkten aus der Kategorie {{ $category->name }}.</p>
            </div>
            <div class="grid-container">
                @foreach($category->products()->take(3)->get() as $product)
                    <x-product-grid :product="$product"></x-product-grid>
                @endforeach
            </div>
            <a class="link-button more-items" href="{{ route('products.category', ['category' => $category->id]) }}">Weitere</a>
        </section>
    @endforeach
@endsection
