<x-base-layout>
    <x-slot name="title">
        Speelschema - Voetbal Frontier
    </x-slot>

    <main class="container mx-auto py-8 px-4">
        <!-- Inleiding van het toernooi -->
        <section class="bg-gray-900 text-gray-100 p-8 rounded-xl shadow-lg transition-all duration-300 mb-8 max-w-4xl mx-auto">
            <h2 class="text-3xl font-extrabold mb-4 text-transparent bg-clip-text" style="background-color: #18978a;">
                Het Speelschema
            </h2>
            <p class="text-lg leading-relaxed">
                Hier vind je de geplande wedstrijden van het Voetbal Frontier Internationaal. Klik op een wedstrijd voor meer details.
            </p>
        </section>

        <!-- Wedstrijden Lijst -->
        <section class="bg-gray-900 text-gray-100 p-8 rounded-xl shadow-lg transition-all duration-300 mb-8 max-w-4xl mx-auto">
            <h3 class="text-2xl font-bold mb-6 text-transparent bg-clip-text" style="background-color: #18978a;">
                Toekomstige Wedstrijden
            </h3>

            @foreach ($wedstrijden as $wedstrijd)
                <div class="bg-gray-800 p-4 rounded-lg mb-4">
                    <p class="text-xl font-semibold text-gray-100">{{ $wedstrijd->team1->name }} vs {{ $wedstrijd->team2->name }}</p>
                    <p class="text-gray-400">{{ $wedstrijd->match_date->format('d-m-Y H:i') }}</p>
                    <p class="text-gray-500">{{ $wedstrijd->location }}</p>
                </div>
            @endforeach
        </section>
    </main>
</x-base-layout>
