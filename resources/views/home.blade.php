<x-base-layout>
    <x-slot name="title">
        Voetbal Frontier
    </x-slot>
    <!-- Main Content -->
    <main class="container mx-auto py-8 px-4">
        <!-- Inleiding van het toernooi -->
        <section class="bg-gray-900 text-gray-100 p-8 rounded-xl shadow-lg transition-all duration-300 mb-8 max-w-4xl mx-auto">
            <h2 class="text-3xl font-extrabold mb-4 text-transparent bg-clip-text" style="background-color: #18978a;">
                Wat is het FFI?
            </h2>
            <p class="text-lg leading-relaxed">
                Welkom bij het Voetbal Frontier Internationaal! Dit toernooi brengt teams van verschillende niveaus samen voor een spannende competitie.
                Bereid je voor op actie, teamwork en veel plezier terwijl we strijden om de overwinning.
                Kijk snel naar het speelschema en ontdek wanneer jouw team in actie komt!
            </p>
        </section>

        <div class="container mx-auto py-8">
            <!-- Countdown to Next Match -->
            <div class="bg-gray-900 text-gray-100 rounded-lg p-8 mb-12 text-center">
                <h2 class="text-3xl font-extrabold mb-6 text-transparent bg-clip-text" style="background-image: linear-gradient(#18978a, #18978a);">Tijd tot wedstrijd</h2>
                <div class="flex items-center justify-center space-x-12">
                    <!-- Club 1 -->
                    <div class="text-center group transform transition-all duration-300 ease-in-out">
                        @if(isset($teams) && $teams->isNotEmpty() && isset($teams[0]))
                            <p class="text-2xl font-semibold">{{ $teams[0]->name }}</p>
                            <div class="bg-gray-700 rounded-xl h-40 w-40 mx-auto flex items-center justify-center group-hover:shadow-lg transform transition-all duration-300">
                                @if($teams[0]->logo_path)
                                    <img src="{{ asset($teams[0]->logo_path) }} "
                                         alt="{{ $teams[0]->name }} Logo"
                                         class="h-24 w-24 object-contain">
                                @else
                                    <span class="text-gray-500">No Logo</span>
                                @endif
                            </div>
                        @else
                            <p class="text-2xl font-semibold">Team 1</p>
                            <div class="bg-gray-700 rounded-xl h-40 w-40 mx-auto flex items-center justify-center group-hover:shadow-lg">
                                <span class="text-gray-500">No Logo</span>
                            </div>
                        @endif
                    </div>

                    <p class="text-2xl font-bold text-gray-300">vs</p>

                    <!-- Club 2 -->
                    <div class="text-center group transform transition-all duration-300 ease-in-out">
                        @if(isset($teams) && $teams->isNotEmpty() && isset($teams[1]))
                            <p class="text-2xl font-semibold">{{ $teams[1]->name }}</p>
                            <div class="bg-gray-700 rounded-xl h-40 w-40 mx-auto flex items-center justify-center group-hover:shadow-lg">
                                @if($teams[1]->logo_path)
                                    <img src="{{ asset($teams[1]->logo_path) }} "
                                         alt="{{ $teams[1]->name }} Logo"
                                         class="h-24 w-24 object-contain">
                                @else
                                    <span class="text-gray-500">No Logo</span>
                                @endif
                            </div>
                        @else
                            <p class="text-2xl font-semibold">Team 2</p>
                            <div class="bg-gray-700 rounded-xl h-40 w-40 mx-auto flex items-center justify-center group-hover:shadow-lg">
                                <span class="text-gray-500">No Logo</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Schedule, Standings, Admin Panel -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <!-- Schedule/Inzetten Section -->
                <a href="{{ route('inzet') }}" class="block transform transition-transform hover:scale-105 rounded-lg">
                    <div class="bg-gray-900 text-gray-100 shadow-lg rounded-lg p-8 relative group hover:bg-gray-800 hover:shadow-2xl transition-all duration-300">
                        <h3 class="text-2xl font-semibold mb-6">Inzetten</h3>
                        <p>Download de applicatie! en Zet je munten slim in en wordt de beste van de school!</p>
                    </div>
                </a>

                <!-- Standings Section -->
                <a href="{{ route('stand') }}" class="block transform transition-transform hover:scale-105 rounded-lg">
                    <div class="bg-gray-900 text-gray-100 shadow-lg rounded-lg p-8 relative group hover:bg-gray-800 hover:shadow-2xl transition-all duration-300">
                        <h3 class="text-2xl font-semibold mb-6">Stand</h3>
                        <ul class="space-y-4">
                            @if(isset($teams) && $teams->isNotEmpty())
                                @foreach($teams as $index => $team)
                                    <li class="flex items-center space-x-4 group hover:bg-gray-800 rounded-lg p-2 transition-all duration-300">
                                        <span class="text-xl font-semibold">{{ $index + 1 }}.</span>
                                        @if($team->logo_path)
                                            <img src="{{ asset($team->logo_path) }} "
                                                 alt="{{ $team->name }} Logo"
                                                 class="h-8 w-8 object-contain">
                                        @endif
                                        <span>{{ $team->name }}</span>
                                    </li>
                                @endforeach
                            @else
                                <li>Geen teams beschikbaar</li>
                            @endif
                        </ul>
                    </div>
                </a>

                <!-- Teamleider Panel Section -->
                @auth
                    @if(auth()->user()->rank === 'teamleider' || auth()->user()->rank === 'admin')
                        <a href="{{ route('teamleider') }}" class="block transform transition-transform hover:scale-105 rounded-lg">
                            <div class="bg-gray-900 text-gray-100 shadow-lg rounded-lg p-8 relative group hover:bg-gray-800 hover:shadow-2xl transition-all duration-300">
                                <h3 class="text-2xl font-semibold mb-6">Teamleider Panel</h3>
                                <p>Beheer opties komen hier voor admins en teamleiders.</p>
                            </div>
                        </a>
                    @endif

                    <!-- Admin Panel Section -->
                    @if(auth()->user()->rank === 'admin')
                        <a href="{{ route('admin') }}" class="block transform transition-transform hover:scale-105 rounded-lg">
                            <div class="bg-gray-900 text-gray-100 shadow-lg rounded-lg p-8 relative group hover:bg-gray-800 hover:shadow-2xl transition-all duration-300">
                                <h3 class="text-2xl font-semibold mb-6">Admin Panel</h3>
                                <p>Beheer accounts en pas gebruikersrangen aan.</p>
                            </div>
                        </a>
                    @endif
                @endauth
            </div>
        </div>
    </main>
</x-base-layout>
