<!DOCTYPE HTML>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>@yield('title')</title>
        <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
        <link rel="icon" href="{{ asset('image/laravel.png') }}">
        <link rel="stylesheet" href='/css/sample.css'>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.0.0/css/all.css">
        <script src="{{ mix('js/jquery.js') }}" defer></script>
        <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    </head>
    <body>
        <header>
        @include('header')
        </header>
        <main>
            @yield('content')
        </main>
        <footer>
        @include('footer')
        </footer>
    </body>
</html>