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
<body class="font-sans antialiased bg-gray-50">
    <div class="min-h-screen flex flex-col justify-center items-center pt-6 sm:pt-0">
        <!-- Logo bovenaan -->
        <div class="text-center mb-8 animate__animated animate__fadeIn animate__delay-1s">
            <a href="/">
                <img src="{{ asset('images/logo.png') }}" class="w-20 h-20 mx-auto" alt="Logo" />
            </a>
        </div>

        <!-- Formuliercontainer in het midden van het scherm -->
        <div class="w-full sm:max-w-md mt-6 px-6 py-8 bg-white shadow-lg rounded-lg overflow-hidden flex flex-col animate__animated animate__fadeIn animate__delay-2s">
            {{ $slot }}
        </div>
    </div>

    <style>
        /* Basis achtergrond en lettertype */
        body {
            background-color: #f3f4f6;
            font-family: 'Figtree', sans-serif;
        }

        /* Stijlen voor de container van de loginpagina */
        .min-h-screen {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        /* Stijlen voor de formuliercontainer */
        .w-full {
            max-width: 400px;
            width: 100%;
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Knoppen en interactie-elementen */
        .primary-button {
            background-color: #10B981; /* Groene kleur */
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        .primary-button:hover {
            background-color: #059669; /* Donkere groene hoverkleur */
        }

        /* Inputvelden */
        .input-background {
            background-color: #F1F5F9; /* Lichtgrijze achtergrond voor inputvelden */
            color: #1F2937; /* Zwarte tekstkleur */
            padding: 10px;
            border: 1px solid #D1D5DB; /* Grijze randkleur */
            border-radius: 5px;
            width: 100%;
            margin-top: 8px;
        }

        /* Foutberichten */
        .input-error {
            color: #DC2626;
            font-size: 0.875rem;
            margin-top: 4px;
        }

        /* Titel en tekstlabels */
        .text-black {
            color: #111827;
        }

        /* Hover effect voor links */
        a:hover {
            color: #10B981;
        }

        /* Toegevoegde animaties voor fade-in effecten */
        @import url('https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css');
    </style>
</body>
</html>
