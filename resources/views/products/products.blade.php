@extends('layouts.master')

@section('head-scripts')
    <link rel="stylesheet" href="{{ asset('css/products.css') }}">
@endsection

@section('content')
    @isset($category)
        <h3>{{ $category->name }}</h3>
    @endisset

    <x-searchbar :query="$query"></x-searchbar>

    @if(count($products) > 0)
        <div class="grid-container">
            @foreach($products as $product)
                <x-product-grid :product="$product"></x-product-grid>
            @endforeach
        </div>
    @else
        <p class="product-not-found">Es wurden keine Produkte gefunden.</p>
    @endif

    {{ $products->links() }}
@endsection
