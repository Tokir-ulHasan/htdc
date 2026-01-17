<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Login</title>
    <meta name="base-url" content="{{ url('/') }}">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white p-6 rounded shadow w-full max-w-md">
            <h1 class="text-xl font-semibold mb-4 text-center">Admin Login</h1>
            <form method="POST" action="/login" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm text-gray-700">Email</label>
                    <input type="email" name="email" class="w-full border rounded px-3 py-2" required />
                </div>
                <div>
                    <label class="block text-sm text-gray-700">Password</label>
                    <input type="password" name="password" class="w-full border rounded px-3 py-2" required />
                </div>
                @if ($errors->any())
                    <div class="text-red-600 text-sm">{{ $errors->first() }}</div>
                @endif
                <button class="w-full bg-green-600 text-white px-4 py-2 rounded">Login</button>
            </form>
        </div>
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
