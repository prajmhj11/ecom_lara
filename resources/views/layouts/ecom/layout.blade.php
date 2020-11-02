<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Laravel Ecommerce | @yield('title', '')</title>

        <link href="/img/favicon.ico" rel="SHORTCUT ICON" />

        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        @yield('extra-css')
    </head>


<body class="@yield('body-class', '')">
            @include('layouts.ecom.partials.nav')

            @yield('content')
        @include('layouts.ecom.partials.footer')


</body>
<script src="{{ asset('js/app.js') }}"></script>
@yield('extra-js')
</html>