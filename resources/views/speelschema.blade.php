<x-base-layout>
    <x-slot name="title">Speelschema - Voetbal Frontier</x-slot>

    <main class="container mx-auto py-8 px-4">
        <section class="bg-gray-900 text-gray-100 p-8 rounded-xl shadow-lg transition-all duration-300 mb-8 max-w-4xl mx-auto">
            <h2 class="text-3xl font-extrabold mb-4 text-transparent bg-clip-text" style="background-color: #18978a;">
                Het Speelschema
            </h2>
            <p class="text-lg leading-relaxed">
                Hier vind je de geplande wedstrijden van het Voetbal Frontier Internationaal.
            </p>
        </section>

        <section class="bg-gray-900 text-gray-100 p-8 rounded-xl shadow-lg transition-all duration-300 mb-8 max-w-4xl mx-auto">
            <h3 class="text-2xl font-bold mb-6 text-transparent bg-clip-text" style="background-color: #18978a;">
                Toekomstige Wedstrijden
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-4 font-semibold text-lg">
                <div>Teams</div>
                <div>Datum</div>
                <div>Tijd</div>
                <div>Locatie</div>
                <div>Scheidsrechter</div> <!-- Nieuwe kolom voor scheidsrechter -->
            </div>

            @foreach ($wedstrijden as $wedstrijd)
                <div class="grid grid-cols-1 md:grid-cols-5 gap-4 bg-gray-800 p-4 rounded-lg mb-4">
                    <div class="text-gray-200">{{ $wedstrijd->team1->name }} vs {{ $wedstrijd->team2->name }}</div>
                    <div class="text-gray-200">
                        @if ($wedstrijd->wedstrijd_tijd)
                            {{ \Carbon\Carbon::parse($wedstrijd->wedstrijd_tijd)->format('d-m-Y') }}
                        @else
                            N/A
                        @endif
                    </div>
                    <div class="text-gray-200">
                        @if ($wedstrijd->wedstrijd_tijd)
                            {{ \Carbon\Carbon::parse($wedstrijd->wedstrijd_tijd)->format('H:i') }}
                        @else
                            N/A
                        @endif
                    </div>
                    <div class="text-gray-200">{{ $wedstrijd->location }}</div>
                    <div class="text-gray-20 0">
                        @if ($wedstrijd->scheidsrechter)
                            {{ $wedstrijd->scheidsrechter }}
                        @else
                            N/A
                        @endif
                    </div>
                </div>
            @endforeach
        </section>
    </main>
</x-base-layout>
