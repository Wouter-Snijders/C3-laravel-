<x-base-layout>
    <x-slot name="title">Wedstrijdmaker</x-slot>

    <main class="container mx-auto py-8 bg-gray-800 rounded-lg shadow-lg">
        <h2 class="text-3xl font-semibold text-gray-200 mb-6">Nieuwe Wedstrijd Toevoegen</h2>

        <form action="{{ route('wedstrijden.store') }}" method="POST" class="bg-gray-700 p-6 rounded-lg shadow-md">
            @csrf
            <div class="mb-4">
                <label for="team_1_id" class="block text-gray-200">Team 1</label>
                <select name="team_1_id" id="team_1_id" class="w-full p-2 bg-gray-800 border border-gray-600 text-gray-200 rounded-lg">
                    @foreach ($teams as $team)
                        <option value="{{ $team->id }}">{{ $team->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="team_2_id" class="block text-gray-200">Team 2</label>
                <select name="team_2_id" id="team_2_id" class="w-full p-2 bg-gray-800 border border-gray-600 text-gray-200 rounded-lg">
                    @foreach ($teams as $team)
                        <option value="{{ $team->id }}">{{ $team->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="locatie" class="block text-gray-200">Locatie</label>
                <input type="text" name="locatie" id="locatie" class="w-full p-2 bg-gray-800 border border-gray-600 text-gray-200 rounded-lg">
            </div>
            <div class="mb-4">
                <label for="datum" class="block text-gray-200">Datum</label>
                <input type="date" name="datum" id="datum" class="w-full p-2 bg-gray-800 border border-gray-600 text-gray-200 rounded-lg">
            </div>

            <button type="submit" class="bg-blue-500 text-white p-2 rounded-lg hover:bg-blue-600 transition duration-300">Wedstrijd Opslaan</button>
        </form>
    </main>
</x-base-layout>
