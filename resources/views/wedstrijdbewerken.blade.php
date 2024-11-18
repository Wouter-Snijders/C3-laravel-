<x-base-layout>
    @auth
        <main class="container mx-auto py-8 px-4">
            <h1 class="text-2xl font-bold mb-6 text-white">Wedstrijd Bewerken</h1>

            <!-- Success Message -->
            @if(session('success'))
                <div class="bg-green-800 border border-green-600 text-green-200 px-4 py-3 rounded relative mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Formulier om wedstrijd te bewerken -->
            <div class="bg-gray-800 shadow-md rounded-lg p-6 mb-6">
                <h3 class="text-xl font-semibold mb-4 text-white">Wedstrijd Bewerken</h3>
                <form action="{{ route('wedstrijden.update', $wedstrijd->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="team1_id" class="block text-sm font-medium text-gray-300">Team 1</label>
                        <select name="team1_id" id="team1_id" class="mt-1 block w-full rounded-md border-gray-600 shadow-sm text-white bg-gray-700" required>
                            @foreach ($teams as $team)
                                <option value="{{ $team->id }}" {{ $team->id == $wedstrijd->team1_id ? 'selected' : '' }}>{{ $team->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="team2_id" class="block text-sm font-medium text-gray-300">Team 2</label>
                        <select name="team2_id" id="team2_id" class="mt-1 block w-full rounded-md border-gray-600 shadow-sm text-white bg-gray-700" required>
                            @foreach ($teams as $team)
                                <option value="{{ $team->id }}" {{ $team->id == $wedstrijd->team2_id ? 'selected' : '' }}>{{ $team->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="location" class="block text-sm font-medium text-gray-300">Locatie</label>
                        <input type="text" name="location" id="location" value="{{ $wedstrijd->location }}" class="mt-1 block w-full rounded-md border-gray-600 shadow-sm text-white bg-gray-700" required>
                    </div>

                    <div class="mb-4">
                        <label for="wedstrijd_tijd" class="block text-sm font-medium text-gray-300">Datum en Tijd</label>
                        <input type="datetime-local" name="wedstrijd_tijd" id="wedstrijd_tijd" value="{{ $wedstrijd_tijd }}" class="mt-1 block w-full rounded-md border-gray-600 shadow-sm text-white bg-gray-700" required>
                    </div>

                    <div class="mb-4">
                        <label for="scheidsrechter" class="block text-sm font-medium text-gray-300">Scheidsrechter</label>
                        <select name="scheidsrechter" id="scheidsrechter" class="mt-1 block w-full rounded-md border-gray-600 shadow-sm text-white bg-gray-700" required>
                            @foreach ($scheidsrechters as $scheidsrechter)
                                <option value="{{ $scheidsrechter->name }}">{{ $scheidsrechter->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-500 transition duration-300">
                        Update Wedstrijd
                    </button>
                </form>
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
