<x-base-layout>
    @auth
        <main class="container mx-auto py-8 px-4">
            <h1 class="text-2xl font-bold mb-6 text-white">Wedstrijdbeheer</h1>

            <!-- Success Message -->
            @if(session('success'))
                <div class="bg-green-800 border border-green-600 text-green-200 px-4 py-3 rounded relative mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Formulier om nieuwe wedstrijd toe te voegen -->
            <div class="bg-gray-800 shadow-md rounded-lg p-6 mb-6">
                <h3 class="text-xl font-semibold mb-4 text-white">Nieuwe Wedstrijd Toevoegen</h3>
                <form action="{{ route('wedstrijden.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="team1_id" class="block text-sm font-medium text-gray-300">Team 1</label>
                        <select name="team1_id" id="team1_id" class="mt-1 block w-full rounded-md border-gray-600 shadow-sm text-white bg-gray-700" required>
                            @foreach ($teams as $team)
                                <option value="{{ $team->id }}">{{ $team->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="team2_id" class="block text-sm font-medium text-gray-300">Team 2</label>
                        <select name="team2_id" id="team2_id" class="mt-1 block w-full rounded-md border-gray-600 shadow-sm text-white bg-gray-700" required>
                            @foreach ($teams as $team)
                                <option value="{{ $team->id }}">{{ $team->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="location" class="block text-sm font-medium text-gray-300">Locatie</label>
                        <input type="text" name="location" id="location" class="mt-1 block w-full rounded-md border-gray-600 shadow-sm text-white bg-gray-700" required>
                    </div>

                    <div class="mb-4">
                        <label for="wedstrijd_tijd" class="block text-sm font-medium text-gray-300">Datum en Tijd</label>
                        <input type="datetime-local" name="wedstrijd_tijd" id="wedstrijd_tijd" class="mt-1 block w-full rounded-md border-gray-600 shadow-sm text-white bg-gray-700" required>
                    </div>

                    <button type="submit" class="bg-green-600 text-white py-2 px-4 rounded hover:bg-green-500 transition duration-300">
                        Voeg Wedstrijd Toe
                    </button>
                </form>
            </div>

            <!-- Wedstrijd Overzicht Sectie -->
            <div class="bg-gray-800 shadow-md rounded-lg p-6">
                <h3 class="text-xl font-semibold mb-4 text-white">Wedstrijden Overzicht</h3>
                <div class="space-y-4">
                    @foreach($wedstrijden as $wedstrijd)
                        <div class="border p-4 rounded-lg bg-gray-700">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-4">
                                    <span class="font-medium text-white">{{ $wedstrijd->team1->name }} vs {{ $wedstrijd->team2->name }}</span>
                                </div>
                                <div class="flex space-x-2">
                                    <!-- Route naar bewerk pagina van de wedstrijd -->
                                    <a href="{{ route('wedstrijden.edit', $wedstrijd->id) }}" class="bg-blue-500 text-white py-1 px-3 rounded hover:bg-blue-600">
                                        Bewerk
                                    </a>

                                    <!-- Verwijder Knop -->
                                    <form action="{{ route('wedstrijden.destroy', $wedstrijd->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 text-white py-1 px-3 rounded hover:bg-red-600" onclick="return confirm('Weet je zeker dat je deze wedstrijd wilt verwijderen?')">
                                            Verwijder
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </main>
    @else
        <div class="container mx-auto py-8 px-4">
            <div class="bg-red-800 border border-red-600 text-red-200 px-4 py-3 rounded relative">
                <strong class="font-bold">Toegang geweigerd!</strong>
                <span class="block sm:inline">Je moet ingelogd zijn om deze pagina te bekijken.</span>
            </div>
        </div>
    @endauth
</x-base-layout>
