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

        <script data-ad-client="ca-pub-4004793749790530" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    </head>


<body class="@yield('body-class', '')">
    <div id="main">
        @include('layouts.ecom.partials.nav')
        <!-- Navigation -->
        <router-view></router-view>
        @yield('content')
        <!-- Main-Content -->
        @include('layouts.ecom.partials.footer')
        <!-- Footer -->
    </div>
</body>
<script src="{{ asset('js/app.js') }}"></script>
<script>
    var scroll = $(window).scrollTop();
    $('html').scrollTop(scroll);
</script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-78RC58WDJS"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-78RC58WDJS');
</script>

@yield('extra-js')
</html>
