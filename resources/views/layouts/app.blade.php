<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>@yield('title', 'Price Comparison')</title>
    <meta charset="UTF-8">
    <meta name="format-detection" content="telephone=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/style.min.css') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('custom-css')
</head>
<body>
    <div class="wrapper">
        @include('layouts.header')
        <main class="page">
            @yield('content')
        </main>
        @include('layouts.footer')
    </div>
    @include('layouts.login-popup')
    <script src="{{ asset('js/app.min.js') }}"></script>
    @yield('custom-js')
</body>
</html>