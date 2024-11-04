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
                        <p class="text-xl font-bold">Club 1</p>
                        <div class="bg-gray-200 rounded-lg h-32 w-32 mx-auto flex items-center justify-center">
                            <img src="/path/to/club1-logo.png" alt="Club 1 Logo" class="h-24 w-24">
                        </div>
                    </div>
                    <p class="text-xl font-semibold">vs</p>
                    <!-- Club 2 -->
                    <div class="text-center">
                        <p class="text-xl font-bold">Club 2</p>
                        <div class="bg-gray-200 rounded-lg h-32 w-32 mx-auto flex items-center justify-center">
                            <img src="/path/to/club2-logo.png" alt="Club 2 Logo" class="h-24 w-24">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Schedule, Standings, Admin Panel -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Schedule/Inzetten Section -->
                <a href="{{ route('inzet') }}" class="block transform transition-transform hover:scale-105">
                    <div class="bg-white shadow-md rounded-lg p-6 relative">
                        <h3 class="text-xl font-semibold mb-4">Inzetten</h3>
                        <p>denk jij dat je het best kan voorspellen? zet je munten slim in en wordt de beste van de school!</p>
                    </div>
                </a>

                <!-- Standings Section -->
                <a href="{{ route('stand') }}" class="block transform transition-transform hover:scale-105">
                    <div class="bg-white shadow-md rounded-lg p-6 relative">
                        <h3 class="text-xl font-semibold mb-4">Stand</h3>
                        <ul class="space-y-2">
                            <li>1. Club 1</li>
                            <li>2. Club 2</li>
                            <li>3. Club 3</li>
                            <li>4. Club 4</li>
                            <li>5. Club 5</li>
                        </ul>
                    </div>
                </a>

                <!-- Admin Panel Section -->
                @if(Auth::check())
                    <a href="{{ route('admin.panel') }}" class="block transform transition-transform hover:scale-105">
                        <div class="bg-white shadow-md rounded-lg p-6 relative">
                            <h3 class="text-xl font-semibold mb-4">Admin Panel</h3>
                            <p>Beheer opties komen hier voor admins en teamleiders.</p>
                        </div>
                    </a>
                @endif
            </div>
        </div>
    </main>
@endsection
