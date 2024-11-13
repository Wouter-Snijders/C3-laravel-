<x-base-layout>
    <x-slot name="title">Wedstrijdmaker</x-slot>

    <main class="container mx-auto py-8 px-4 bg-gray-100 rounded-lg shadow-lg">
        <h2 class="text-3xl font-semibold mb-6">Nieuwe Wedstrijd Toevoegen</h2>

        <form action="{{ route('wedstrijden.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
            @csrf
            <div class="mb-4">
                <label for="team_1_id" class="block">Team 1</label>
                <select name="team_1_id" id="team_1_id" class="w-full p-2 border rounded-lg bg-gray-200">
                    @foreach ($teams as $team)
                        <option value="{{ $team->id }}">{{ $team->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="team_2_id" class="block">Team 2</label>
                <select name="team_2_id" id="team_2_id" class="w-full p-2 border rounded-lg bg-gray-200">
                    @foreach ($teams as $team)
                        <option value="{{ $team->id }}">{{ $team->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="locatie" class="block">Locatie</label>
                <input type="text" name="locatie" id="locatie" class="w-full p-2 border rounded-lg bg-gray-200">
            </div>
            <div class="mb-4">
                <label for="datum" class="block">Datum</label>
                <input type="date" name="datum" id="datum" class="w-full p-2 border rounded-lg bg-gray-200">
            </div>

            <button type="submit" class="bg-blue-500 text-white p-2 rounded-lg hover:bg-blue-600 transition duration-300">Wedstrijd Opslaan</button>
        </form>
    </main>
</x-base-layout>
