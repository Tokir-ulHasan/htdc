<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin Dashboard - Hazera-Taju Degree College</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Base URL for JS components -->
    <meta name="base-url" content="{{ url('/') }}">
    <base href="{{ url('/') }}/">
    <!-- Styles -->
    <link href="{{ url(ltrim(mix('css/app.css'), '/')) }}" rel="stylesheet">
</head>
<body class="font-sans antialiased">
    <div id="app">
        <admin-layout>
            @yield('content')
        </admin-layout>
    </div>

    <!-- Scripts -->
    <script src="{{ url(ltrim(mix('js/app.js'), '/')) }}"></script>
    @yield('scripts')
</body>
</html>
