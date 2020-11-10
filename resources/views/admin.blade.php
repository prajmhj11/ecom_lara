<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="/css/app.css">
        <!-- Styles -->

        <style>
            body {
                font-family: 'Nunito';
            }
        </style>
    </head>
    <body>
        @if (Route::has('login'))
            <div class="strip d-flex justify-content-end px-4 py-3 bg-dark">
                @auth('admin')
                    <a href="{{ url('/home') }}" class="text-md text-white">Home</a>
                @else
                    <a href="{{ route('admin.login') }}" class="text-md text-white">Login</a>
                @endif
            </div>
        @endif
        <div class="text-center mt-5" id="app">
            <h1>ADMIN PAGE</h1>
        </div>
    </body>
    <script src="/js/app.js"></script>
</html>
