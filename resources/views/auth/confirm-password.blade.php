@extends('layouts.master')

@section('head-scripts')
    <link rel="stylesheet" href="{{ asset('css/auth-forms.css') }}"/>
@endsection

@section('content')
    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <h2>Gesicherter Bereich</h2>
        <div>
            Du versuchst auf einen Bereich zuzugreifen, der eine zusätzliche Passwortbestätigung erfordert.
            Bitte gebe Dein Passwort erneut ein!
        </div>

        <!-- Password -->
        <input id="password" type="password" name="password" required/>
        <label for="password">Passwort</label>

        <button type="submit">Anmelden</button>

        <a class="link-button" href="{{ route('register') }}">Noch kein Konto?</a>
        @if ($errors->any())
            <p class="error">Email oder Passwort falsch!</p>
        @endif
    </form>
@endsection
