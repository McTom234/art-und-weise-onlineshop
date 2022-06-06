<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Schülerfirma Art und Weise | Bestellung</title>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>

<body>
@include('layouts.navigation', ['index' => 'about'])

<main>
    <!--    TODO Content-->

    <h2>Danke für Ihren Besuch!</h2>

    <!--    TODO Email-->

    <p>Wir arbeiten zur Zeit mit Hochdruck an der Fertigstellung dieser Seite.<br/>
        Sollten Sie sonstige Fragen zu der Schülerfirma <b>Art und Weise</b>, dem Konzept von Schülerfirmen oder generelles Interesse haben und gerne mehr erfahren möchten, können Sie uns per <a href="mailto:jonas">E-Mail</a> erreichen.</p>

    <h3>Ablauf der Bestellung</h3>

    <p></p>

    <h3>Versand und Versandkosten</h3>

    <p></p>
</main>

@include('layouts.footer')
</body>

</html>
