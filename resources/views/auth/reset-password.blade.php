@extends('layouts.master')

@section('head-scripts')
    <link rel="stylesheet" href="{{ asset('css/auth-forms.css') }}">
@endsection

@section('content')
    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <h2>Password Zurücksetzen</h2>

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <input id="email" type="email" name="email" value="{{ old('email', $request->get('email')) }}" required autofocus/>
        <label for="email">E-Mail</label>

        <!-- Password -->
        <input id="password" type="password" name="password" required/>
        <label for="password">Passwort</label>

        <!-- Confirm Password -->
        <input id="password_confirmation" type="password" name="password_confirmation" required/>
        <label for="password_confirmation">Passwort bestätigen</label>

        <button type="submit">Passwort zurücksetzen</button>

        <a class="link-button" href="{{ route('login') }}">Anmelden</a>

        @if ($errors->any())
            <p class="error">
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </p>
        @endif
    </form>
@endsection
