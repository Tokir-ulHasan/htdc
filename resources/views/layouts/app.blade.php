<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Base URL for JS components -->
    <meta name="base-url" content="{{ url('/') }}">
    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <style>

        body {
            background: #ffffff;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.99) 29%, rgba(217, 255, 238, 1) 87%);
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-100 lg:mx-20 sm:mx-0 md:mx-6">
    <div id="app">
        <app-layout>
            @yield('content')
        </app-layout>
    </div>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
