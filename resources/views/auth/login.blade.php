@extends('layouts.master')

@section('head-scripts')
    <link rel="stylesheet" href="{{ asset('css/auth-forms.css') }}"/>
@endsection

@section('content')
    <form id="menu" action="{{ route('login') }}" method="post">
        @csrf
        <h2>Anmeldung</h2>

        <input id="email" type="email" name="email" value="{{ old('email') }}" required/>
        <label for="email">E-Mail</label>

        <input id="password" type="password" name="password" required/>
        <label for="password">Passwort</label>

        <button type="submit">Anmelden</button>

        <a class="link-button" href="{{ route('register') }}">Noch kein Konto?</a>
        @if ($errors->any())
            <p class="error">Email oder Passwort falsch!</p>
        @endif
    </form>
@endsection
