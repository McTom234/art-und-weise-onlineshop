@extends('layouts.master')

@section('head-scripts')
    <link rel="stylesheet" href="{{ asset('css/ordered.css') }}">
@endsection

@section('content')
    <h2>Danke für Ihre Bestellung!</h2>

    <!-- TODO Email-->

    <p>Wir bearbeiten Ihre Bestellung und werden uns in Kürze bei Ihnen per E-Mail melden.<br/>
        Sollten Sie weitere Fragen zum Bestellvorgang haben, können Sie uns per <a href="mailto:TODO">E-Mail</a> erreichen.</p>

    <a href="{{ route('index') }}" class="link-button">Zur Startseite</a> <a href="{{ route('about') }}" class="link-button">Mehr über uns</a>
@endsection
