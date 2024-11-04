<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voetbal Toernooi</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.0/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
    <header class="bg-gray-800 text-yellow-400 py-4 shadow-md shadow-lg py-9">
        <div class="container mx-auto flex items-center justify-between px-4">
            <div class="flex items-center">
                <a href="/"><img src="{{ asset('images/logo.png') }}" alt="GianoPlaats Logo" class="w-20 h-auto"></a>
                <h1 class="text-2xl font-bold ml-2">Voetbal Frontier</h1>
            </div>
            <nav>
                <ul class="flex space-x-4">
                    <li><a href="#" class="nav-link hover:text-yellow-300 transition-all">Stand</a></li>
                    <li><a href="#" class="nav-link hover:text-yellow-300 transition-all">Speel schema</a></li>
                    <li><a href="#" class="nav-link hover:text-yellow-300 transition-all">Inzetten</a></li>

                    @if(Auth::check())
                        <li><a href="#" class="nav-link hover:text-yellow-300 transition-all">Admin Panel</a></li>
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

    <!-- Dit gedeelte wordt vervangen door de content van de child views -->
    <main class="container mx-auto py-8 px-4">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-yellow-400 py-4 mt-8">
        <div class="container mx-auto text-center">
            <p>&copy; {{ date('Y') }} Voetbal Toernooi. Alle rechten voorbehouden.</p>
            <div class="flex justify-center space-x-4 mt-2">
                <a href="https://x.com/curioonderwijs" class="hover:text-yellow-300 transition-transform transform hover:scale-110">
                    <i class="fa-brands fa-twitter"></i>
                </a>
                <a href="https://www.instagram.com/curioonderwijsgroep/" class="hover:text-yellow-300 transition-transform transform hover:scale-110">
                    <i class="fa-brands fa-instagram"></i>
                </a>
                <a href="https://www.facebook.com/curioonderwijs/?locale=nl_NL" class="hover:text-yellow-300 transition-transform transform hover:scale-110">
                    <i class="fa-brands fa-facebook"></i>
                </a>
            </div>
        </div>
    </footer>

</body>
</html>
