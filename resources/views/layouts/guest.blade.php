<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="min-h-screen">
        <!-- Logo bovenaan -->
        <div class="logo-container">
            <a href="/">
                <img src="{{ asset('images/logo.png') }}" class="logo" alt="Logo" />
            </a>
        </div>

        <!-- Formuliercontainer in het midden van het scherm -->
        <div class="form-container">
            {{ $slot }}
        </div>
    </div>
</body>
</html>
