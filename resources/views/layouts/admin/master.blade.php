<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>@yield('title', config('app.name', ''))</title>
    <meta name="description" content="@yield('description', '')">
    <meta name="keywords" content="@yield('keywords', '')">

    <link rel="stylesheet" href="{{ asset('css/index.css') }}">

    <script src="{{ asset('js/app.js') }}" type="application/javascript"></script>

    @yield('head-scripts', '')
</head>
<body>
    @yield('header', '')

    @include('layouts.admin.navigation')

    @yield('body-before-content', '')
    <main>
        @yield('content', trans('general.no_content'))
    </main>
    @yield('body-after-content', '')

    @include('layouts.footer')

    <x-cookie-hint></x-cookie-hint>

    @yield('foot-scripts', '')
    <script>
        const url = window.location.href.split('#');
        while (url.length >= 2 && url[url.length-1] !== "") {
            url.pop();
            window.location.href = url.join();
        }
    </script>
</body>
</html>
