<!DOCTYPE html>
<html lang="nl">
    <x-head :title="$title ?? 'Voetbal Frontier'"></x-head>
<body class="bg-gray-900 text-gray-100 font-poppins">

    <header id="header" class="bg-gradient-to-r from-gray-900 via-gray-700 to-gray-900 text-gray-200 py-4 font-sans tracking-wide shadow-lg sticky top-0">
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
                    <li><a href="{{ route('stand') }}" class="text-gray-200 transition-all" style="color: gray;">Stand</a></li>
                    <li><a href="{{ route('speelschema') }}" class="text-gray-200 transition-all" style="color: gray;">Speelschema</a></li>
                    <li><a href="{{ route('inzet') }}" class="text-gray-200 transition-all" style="color: gray;">Inzetten</a></li>

                    @if(Auth::check())
                        <!-- Admin Panel zichtbaar alleen voor admin -->
                        @if(Auth::user()->rank === 'admin')
                            <li><a href="{{ route('admin') }}" class="text-gray-200 transition-all" style="color: gray;">Admin Panel</a></li>
                        @endif

                        @if(auth()->user()->rank === 'scheidsrechter' || auth()->user()->rank === 'admin')
                            <li><a href="{{ route('wedstrijdmaker') }}" class="text-gray-200 transition-all" style="color: gray;">Wedstrijd Panel</a></li>
                        @endif

                        <!-- Teamleider Panel zichtbaar voor zowel teamleiders als admins -->
                        @if(Auth::user()->rank === 'teamleider' || Auth::user()->rank === 'admin')
                            <li><a href="{{ route('teamleider') }}" class="text-gray-200 transition-all" style="color: gray;">Teamleider Panel</a></li>
                        @endif

                        <li class="relative flex items-center">
                            <span class="mr-2 text-gray-200 cursor-pointer" onclick="toggleLogout()" id="user-name">
                                <i class="fas fa-user-circle mr-2"></i> {{ Auth::user()->name }}
                            </span>
                            <a href="{{ route('logout') }}"
                               class="text-gray-200 transition-all opacity-0 pointer-events-none absolute"
                               style="top: 100%; color: gray; transition: opacity 0.3s ease;"
                               id="logout-link"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Uitloggen
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>

                    @else
                        <li><a href="{{ route('login') }}" class="text-gray-200 transition-all" style="color: gray;">Inloggen</a></li>
                        <li><a href="{{ route('register') }}" class="text-gray-200 transition-all" style="color: gray;">Registreren</a></li>
                    @endif

                </ul>
            </nav>

            <script>
                function toggleLogout() {
                    const logoutLink = document.getElementById('logout-link');
                    if (logoutLink.classList.contains('opacity-0')) {
                        logoutLink.classList.remove('opacity-0', 'pointer-events-none');
                    } else {
                        logoutLink.classList.add('opacity-0', 'pointer-events-none');
                    }
                }
            </script>

        </div>
    </header>

    <!-- Main content -->
    <main class="container mx-auto py-8 px-4 bg-gray-800 border-t-2 border-gray-600 fade-in">
        {{ $slot }}
    </main>

    <footer class="bg-gradient-to-r from-gray-900 via-gray-700 to-gray-900 text-gray-200 font-sans tracking-wide py-12 px-12 mt-8">
        <div class="container mx-auto text-center flex justify-center items-center">
            <div class="flex flex-wrap items-center sm:justify-between max-sm:flex-col gap-6">
                <div>
                    <a href="/">

                    </a>
                </div>
            </div>
        </div>

        <hr class="my-6 border-gray-500" />

        <p id="footerText" class="text-center text-gray-200 text-base">&copy; {{ date(' F Y') }} Voetbal Toernooi. Alle rechten voorbehouden.</p>
        <div class="flex justify-center space-x-4 mt-2">
            <a href="https://x.com/wjhulzebosch" class="text-gray-200 hover:text-gray-400 transition-transform transform hover:scale-110">
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
