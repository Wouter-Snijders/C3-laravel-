<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voetbal Toernooi</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.0/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Aangepaste stijlen voor animaties */
        .transition-all {
            transition: all 0.3s ease;
        }
        .nav-link:hover {
            text-shadow: 0 0 5px rgba(255, 255, 255, 0.8);
        }
        /* Prevent overflow */
        body {
            overflow-x: hidden; /* Verhindert horizontale scrollbars */
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-900">

    <!-- Header -->
    <header class="bg-gray-800 text-yellow-400 py-4 shadow-md">
        <div class="container mx-auto flex items-center justify-between px-4">
            <div class="flex items-center">
                <a href="/"><img src="{{ asset('images/logo.png') }}" alt="GianoPlaats Logo" class="w-20 h-auto"></a>
                <h1 class="text-2xl font-bold ml-2">Voetbal Frontier</h1>
            </div>
            <nav>
                <ul class="flex space-x-4"> <!-- Ruimte tussen de links verkleinen -->
                    <li><a href="#" class="nav-link hover:text-yellow-300 transition-all">Stand</a></li>
                    <li><a href="#" class="nav-link hover:text-yellow-300 transition-all">Speel schema</a></li>
                    <li><a href="#" class="nav-link hover:text-yellow-300 transition-all">Inzetten</a></li>
                    <li><a href="#" class="nav-link hover:text-yellow-300 transition-all">Admin Panel</a></li>

                    @if(Auth::check())
                        <li class="flex items-center">
                            <span class="mr-2">{{ Auth::user()->name }}</span>
                            <a href="{{ route('logout') }}" class="text-yellow-400 hover:text-yellow-300 transition-all"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Uitloggen</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    @else
                        <li><a href="{{ route('login') }}" class="nav-link hover:text-yellow-300 transition-all">Inloggen</a></li>
                        <li><a href="{{ route('register') }}" class="nav-link hover:text-yellow-300 transition-all">Registreren</a></li>
                    @endif
                </ul>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto py-8 px-4">
        <!-- Inleiding van het toernooi -->
        <section class="bg-yellow-100 text-gray-900 p-6 rounded-lg shadow-md mb-6">
            <h2 class="text-xl font-semibold mb-2">Wat is het FFI?</h2>
            <p>
                Welkom bij het Voetbal Frontier Toernooi! Dit toernooi brengt teams van verschillende niveaus samen voor een spannende competitie.
                Bereid je voor op actie, teamwork en veel plezier terwijl we strijden om de overwinning.
                Kijk snel naar het speelschema en ontdek wanneer jouw team in actie komt!
            </p>
        </section>

        <!-- Dit gedeelte wordt vervangen door de content van de child views -->
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-yellow-400 py-4 mt-8">
        <div class="container mx-auto text-center">
            <p>&copy; {{ date('Y') }} Voetbal Toernooi. Alle rechten voorbehouden.</p>
            <div class="flex justify-center space-x-4 mt-2">
                <a href="#" class="hover:text-yellow-300 transition-all">F</a>
                <a href="#" class="hover:text-yellow-300 transition-all">F</a>
                <a href="#" class="hover:text-yellow-300 transition-all">I</a>
            </div>
        </div>
    </footer>

</body>
</html>
