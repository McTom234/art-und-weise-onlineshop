<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schülerfirma Art und Weise | Login</title>
    <link rel="stylesheet" href="{{asset('css/user-forms.css')}}"/>
</head>

<body>
@include('layouts.navigation', ['index' => 'login'])

<main>
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

</main>
@include('layouts.footer')
</body>
</html>
