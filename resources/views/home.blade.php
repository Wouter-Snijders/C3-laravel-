@extends('layouts.base')

@section('content')
    <!-- Main Content -->
    <main class="container mx-auto py-8 px-4">
        <!-- Inleiding van het toernooi -->
        <section class="bg-yellow-100 text-gray-900 p-6 rounded-lg shadow-md mb-6">
            <h2 class="text-xl font-semibold mb-2">Wat is het FFI?</h2>
            <p>
                Welkom bij het Voetbal Frontier Internationaal! Dit toernooi brengt teams van verschillende niveaus samen voor een spannende competitie.
                Bereid je voor op actie, teamwork en veel plezier terwijl we strijden om de overwinning.
                Kijk snel naar het speelschema en ontdek wanneer jouw team in actie komt!
            </p>
        </section>

        <div class="container mx-auto py-8">
            <!-- Countdown to Next Match -->
            <div class="bg-white shadow-md rounded-lg p-6 mb-8 text-center">
                <h2 class="text-2xl font-semibold mb-4">Tijd tot wedstrijd</h2>
                <div class="flex items-center justify-center space-x-8">
                    <!-- Club 1 -->
                    <div class="text-center">
                        @if(isset($teams) && $teams->isNotEmpty() && isset($teams[0]))
                            <p class="text-xl font-bold">{{ $teams[0]->name }}</p>
                            <div class="bg-gray-200 rounded-lg h-32 w-32 mx-auto flex items-center justify-center">
                                @if($teams[0]->logo_path)
                                    <img src="{{ asset($teams[0]->logo_path) }}"
                                         alt="{{ $teams[0]->name }} Logo"
                                         class="h-24 w-24 object-contain">
                                @else
                                    <span class="text-gray-500">No Logo</span>
                                @endif
                            </div>
                        @else
                            <p class="text-xl font-bold">Team 1</p>
                            <div class="bg-gray-200 rounded-lg h-32 w-32 mx-auto flex items-center justify-center">
                                <span class="text-gray-500">No Logo</span>
                            </div>
                        @endif
                    </div>

                    <p class="text-xl font-semibold">vs</p>

                    <!-- Club 2 -->
                    <div class="text-center">
                        @if(isset($teams) && $teams->isNotEmpty() && isset($teams[1]))
                            <p class="text-xl font-bold">{{ $teams[1]->name }}</p>
                            <div class="bg-gray-200 rounded-lg h-32 w-32 mx-auto flex items-center justify-center">
                                @if($teams[1]->logo_path)
                                    <img src="{{ asset($teams[1]->logo_path) }}"
                                         alt="{{ $teams[1]->name }} Logo"
                                         class="h-24 w-24 object-contain">
                                @else
                                    <span class="text-gray-500">No Logo</span>
                                @endif
                            </div>
                        @else
                            <p class="text-xl font-bold">Team 2</p>
                            <div class="bg-gray-200 rounded-lg h-32 w-32 mx-auto flex items-center justify-center">
                                <span class="text-gray-500">No Logo</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Schedule, Standings, Admin Panel -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Schedule/Inzetten Section -->
                <a href="{{ route('inzet') }}" class="block transform transition-transform hover:scale-105">
                    <div class="bg-white shadow-md rounded-lg p-6 relative">
                        <h3 class="text-xl font-semibold mb-4">Inzetten</h3>
                        <p>Denk jij dat je het best kan voorspellen? Zet je munten slim in en wordt de beste van de school!</p>
                    </div>
                </a>

                <!-- Standings Section -->
                <a href="{{ route('stand') }}" class="block transform transition-transform hover:scale-105">
                    <div class="bg-white shadow-md rounded-lg p-6 relative">
                        <h3 class="text-xl font-semibold mb-4">Stand</h3>
                        <ul class="space-y-2">
                            @if(isset($teams) && $teams->isNotEmpty())
                                @foreach($teams as $index => $team)
                                    <li class="flex items-center space-x-2">
                                        <span>{{ $index + 1 }}.</span>
                                        @if($team->logo_path)
                                            <img src="{{ asset($team->logo_path) }}"
                                                 alt="{{ $team->name }} Logo"
                                                 class="h-6 w-6 object-contain">
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

                <!-- Admin Panel Section -->
                @auth
                    <a href="{{ route('admin') }}" class="block transform transition-transform hover:scale-105">
                        <div class="bg-white shadow-md rounded-lg p-6 relative">
                            <h3 class="text-xl font-semibold mb-4">Admin Panel</h3>
                            <p>Beheer opties komen hier voor admins en teamleiders.</p>
                        </div>
                    </a>
                @endauth
            </div>
        </div>
    </main>
@endsection
