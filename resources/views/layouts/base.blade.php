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
        /* Titel animatie */
        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
                color: rgb(222, 215, 215); /* Oorspronkelijke kleur */
            }
            50% {
                transform: scale(1.1);
                color: rgb(137, 137, 137); /* Lichtere kleur tijdens animatie */
            }
        }
        .animated-title {
            animation: pulse 2s infinite;
        }

        /* Prevent overflow */
        body {
            overflow-x: hidden; /* Verhindert horizontale scrollbars */
        }

        /* Custom hover effects */
        .scale-up {
            transition: transform 0.3s ease-in-out;
        }
        .scale-up:hover {
            transform: scale(1.05);
        }

        /* Fade-in animation */
        .fade-in {
            animation: fadeIn 1s ease-out forwards;
        }

        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }

        /* Shadow effect on hover */
        .shadow-hover:hover {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        }

        /* Donkerblauwe header achtergrond */
        header {
            background-color: #1e3a8a; /* Donkerblauw */
        }

        /* Donkere hover kleuren voor links */
        nav a:hover {
            color: #3b82f6; /* Koud blauw als hover kleur */
        }

        .shine {
    font-size: 1.3em;
    font-weight: 1000;
    color: rgba(255, 255, 255, 0.703);
    background: #222 -webkit-gradient(
        linear,
        left top,
        right top,
        from(#222),
        to(#222),
        color-stop(0.9, #fff)
      ) 0 0 no-repeat;
    background-image: -webkit-linear-gradient(
      -40deg,
      transparent 0%,
      transparent 40%,
      #fff 50%,
      transparent 60%,
      transparent 100%
    );
    -webkit-background-clip: text;
    -webkit-background-size: 50px;
    -webkit-animation: zezzz;
    -webkit-animation-duration: 5s;
    -webkit-animation-iteration-count: infinite;
  }
  @-webkit-keyframes zezzz {
    0%,
    10% {
      background-position: -200px;
    }
    20% {
      background-position: top left;
    }
    100% {
      background-position: 200px;
    }
  }


    </style>
</head>
<body class="bg-gray-900 text-gray-100 font-poppins">

    <header class="bg-gradient-to-r from-gray-900 via-gray-700 to-gray-900 text-gray-200 py-4 font-sans tracking-wide shadow-lg">
        <div class="container mx-auto flex items-center justify-between px-12">
            <div class="flex items-center">
                <a href="/">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-20 h-auto" />
                </a>
                <h1 class="text-2xl font-bold ml-2 shine">
                    <span id="typed-title"></span>
                    <div class="shine">Voetbal Frontier</div>
                </h1>


            </div>
            <nav>
                <ul class="flex space-x-6">
                    <li><a href="{{ route('stand') }}" class="text-gray-200 hover:text-gray-400 transition-all">Stand</a></li>
                    <li><a href="{{ route('speelschema') }}" class="text-gray-200 hover:text-gray-400 transition-all">Speelschema</a></li>
                    <li><a href="{{ route('inzet') }}" class="text-gray-200 hover:text-gray-400 transition-all">Inzetten</a></li>
                    @if(Auth::check())
                        <li><a href="{{ route('admin') }}" class="text-gray-200 hover:text-gray-400 transition-all">Admin Panel</a></li>
                        <li class="flex items-center">
                            <span class="mr-2 text-gray-200">{{ Auth::user()->name }}</span>
                            <a href="{{ route('logout') }}" class="text-gray-200 hover:text-gray-400 transition-all" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Uitloggen</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    @else
                        <li><a href="{{ route('login') }}" class="text-gray-200 hover:text-gray-400 transition-all">Inloggen</a></li>
                        <li><a href="{{ route('register') }}" class="text-gray-200 hover:text-gray-400 transition-all">Registreren</a></li>
                    @endif
                </ul>
            </nav>
        </div>
    </header>


    <!-- Main content -->
    <main class="container mx-auto py-8 px-4 bg-gray-800 border-t-2 border-gray-600 fade-in">
        @yield('content')
    </main>

    <footer class="bg-gradient-to-r from-gray-900 via-gray-700 to-gray-900 text-gray-200 font-sans tracking-wide py-12 px-12 mt-8">
        <div class="container mx-auto text-center flex justify-center items-center">
            <div class="flex flex-wrap items-center sm:justify-between max-sm:flex-col gap-6">
                <div>
                    <a href="/">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-44" />
                    </a>
                </div>
            </div>
        </div>

        <hr class="my-6 border-gray-500" />

        <p class="text-center text-gray-200 text-base">&copy; {{ date('Y') }} Voetbal Toernooi. Alle rechten voorbehouden.</p>
        <div class="flex justify-center space-x-4 mt-2">
            <a href="https://x.com/curioonderwijs" class="text-gray-200 hover:text-gray-400 transition-transform transform hover:scale-110">
                <i class="fa-brands fa-twitter"></i>
            </a>
            <a href="https://www.instagram.com/curioonderwijsgroep/" class="text-gray-200 hover:text-gray-400 transition-transform transform hover:scale-110">
                <i class="fa-brands fa-instagram"></i>
            </a>
            <a href="https://www.facebook.com/curioonderwijs/?locale=nl_NL" class="text-gray-200 hover:text-gray-400 transition-transform transform hover:scale-110">
                <i class="fa-brands fa-facebook"></i>
            </a>
        </div>
    </footer>




</body>
</html>
