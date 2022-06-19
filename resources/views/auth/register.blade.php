@extends('layouts.master')

@section('head-scripts')
    <link rel="stylesheet" href="{{asset('css/user-forms.css')}}"/>
@endsection

@section('content')
    <form method="post" action="{{ route('register') }}" id="menu">
        @csrf
        <h2>Registrierung</h2>
        <fieldset>
            <div>
                <input id="forename" type="text" class="form_input" name="forename" value="{{ old('forename') }}" required/>
                <label for="forename">Vorname</label>
            </div>

            <div>
                <input id="surname" type="text" class="form_input" name="surname" value="{{ old('surname') }}" required/>
                <label for="surname">Nachname</label>
            </div>
        </fieldset>

        <fieldset>
            <div>
                <input id="street" type="text" class="form_input" name="street" value="{{ old('street') }}" required/>
                <label for="street">Straße</label>
            </div>

            <div>
                <input id="street_number" type="text" class="form_input" name="street_number" value="{{ old('street_number') }}" required/>
                <label for="street_number">Nummer</label>
            </div>

            <div>
                <input id="postcode" type="text" class="form_input" name="postcode" value="{{ old('postcode') }}" required/>
                <label for="postcode">PLZ</label>
            </div>

            <div>
                <input id="city" type="text" class="form_input" name="city" value="{{ old('city') }}" required/>
                <label for="city">Stadt</label>
            </div>
        </fieldset>

        <input id="email" type="email" class="form_input" name="email" value="{{ old('email') }}" required/>
        <label for="email">E-Mail</label>

        <input id="password" type="password" class="form_input" name="password" autocomplete="new-password" required/>
        <label for="password">Passwort</label>

        <input id="password_confirmation" type="password" class="form_input" name="password_confirmation" required/>
        <label for="password_confirmation">Passwort wiederholen</label>

        <button type="submit">Registrieren</button>

        <a class="link-button" href="{{ route('login') }}">Bereits ein Konto?</a>

        @if ($errors->any())
            <p class="error">
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </p>
        @endif
    </form>
@endsection
