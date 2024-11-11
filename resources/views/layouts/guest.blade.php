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

    <style>
        /* Basis achtergrond en lettertype */
        body {
            background-color: #1F2937; /* Donkergrijze achtergrond */
            font-family: 'Figtree', sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Stijlen voor de container van de loginpagina */
        .min-h-screen {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        /* Stijlen voor de logo-container */
        .logo-container {
            text-align: center;
            margin-bottom: 2rem;
            animation: fadeIn 1s ease-in-out;
        }

        .logo {
            width: 120px; /* Groter logo */
            height: 120px;
        }

        /* Stijlen voor de formuliercontainer */
        .form-container {
            width: 100%;
            max-width: 400px;
            padding: 30px;
            background-color: #2D3748; /* Donkergrijze achtergrond voor formuliercontainer */
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2); /* Schaduw voor container */
            animation: fadeIn 1.5s ease-in-out;
        }

        /* Knoppen en interactie-elementen */
        .primary-button {
            background-color: #15231e; /* Groene kleur */
            color: white;
            border: none;
            padding: 14px 28px; /* Grotere knoppen met padding */
            font-size: 1.1rem; /* Grotere tekst */
            font-weight: 600; /* Dikkere tekst */
            border-radius: 8px; /* Iets afgeronde hoeken */
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s ease, transform 0.2s ease; /* Toevoegen van animatie voor hover */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3); /* Schaduw voor knop */
        }

        .primary-button:hover {
            background-color: #5e3737; /* Donkere groene hoverkleur */
            transform: translateY(-2px); /* Kleine beweging omhoog bij hover */
        }

        /* Wachtwoord vergeten knop */
.forgot-password {
    text-align: center;
    margin-top: 12px;
}

.forgot-password a {
    color: #E2E8F0; /* Lichte tekstkleur */
    font-size: 1rem; /* Normale tekstgrootte */
    font-weight: 500; /* Medium gewicht */
    text-decoration: none;
    position: relative; /* Voor animatie-effect */
    display: inline-block; /* Zorgt ervoor dat de animatie goed werkt */
    transition: color 0.3s ease; /* Vloeibare overgang voor kleurverandering */
}

.forgot-password a:hover {
    color: #10B981; /* Groene kleur bij hover */
}

.forgot-password a::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 2px;
    background-color: #10B981; /* Groene lijn onder de tekst */
    transform: scaleX(0); /* Maakt de lijn in het begin onzichtbaar */
    transform-origin: bottom right; /* Start animatie vanaf de rechterkant */
    transition: transform 0.3s ease; /* Vloeiende animatie */
}

.forgot-password a:hover::after {
    transform: scaleX(1); /* Laat de lijn groeien naar de volledige breedte bij hover */
    transform-origin: bottom left; /* Laat de lijn van links naar rechts groeien */
}

        /* Inputvelden */
        .input-background {
            background-color: #4A5568; /* Donkergrijze achtergrond voor inputvelden */
            color: #E2E8F0; /* Lichtgrijze tekstkleur */
            padding: 12px; /* Grotere padding */
            border: 1px solid #2D3748; /* Donkergrijze randkleur */
            border-radius: 5px;
            width: 100%;
            margin-top: 12px; /* Grotere marge tussen de velden */
            font-size: 1rem; /* Grotere tekst voor de invoervelden */
        }

        /* Foutberichten */
        .input-error {
            color: #DC2626;
            font-size: 0.875rem;
            margin-top: 4px;
        }

        /* Titel en tekstlabels */
        .text-black {
            color: #E2E8F0; /* Lichtgrijze tekstkleur voor titel */
            font-size: 1.25rem; /* Grotere tekst voor titels */
            font-weight: 700; /* Dikkere tekst voor de titel */
        }

        /* Hover effect voor links */
        a:hover {
            color: #10B981;
        }

        /* Animatie voor fade-in effecten */
        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }
    </style>
</body>
</html>
