@extends('layouts.base')

@section('content')
    @auth
        <main class="container mx-auto py-8 px-4">
            <h1 class="text-2xl font-bold mb-6">Admin Panel</h1>

            <!-- Success Message -->
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Team Management Section -->
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h3 class="text-xl font-semibold mb-4">Team Toevoegen</h3>
                    <form action="{{ route('team.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="team_name" class="block text-sm font-medium text-gray-700">Team Naam</label>
                            <input type="text" name="team_name" id="team_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                        </div>
                        <div class="mb-4">
                            <label for="team_logo" class="block text-sm font-medium text-gray-700">Team Logo</label>
                            <input type="file" name="team_logo" id="team_logo" class="mt-1 block w-full" accept="image/*" required>
                        </div>
                        <button type="submit" class="bg-green-600 text-white py-2 px-4 rounded hover:bg-yellow-500 transition duration-300">
                            Voeg Team Toe
                        </button>
                    </form>
                </div>

                <!-- Team Overview Section -->
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h3 class="text-xl font-semibold mb-4">Teams Overzicht</h3>
                    <div class="space-y-4">
                        @forelse($teams as $team)
                            <div class="border p-4 rounded-lg">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-4">
                                        @if($team->logo_path)
                                            <img src="{{ asset($team->logo_path) }}" alt="{{ $team->name }}" class="w-12 h-12 object-cover rounded">
                                        @else
                                            <div class="w-12 h-12 bg-gray-200 rounded flex items-center justify-center">
                                                <span class="text-gray-500">No Logo</span>
                                            </div>
                                        @endif
                                        <span class="font-medium">{{ $team->name }}</span>
                                    </div>
                                    <div class="flex space-x-2">
                                        <button onclick="toggleEdit({{ $team->id }})" class="bg-blue-500 text-white py-1 px-3 rounded hover:bg-blue-600">
                                            Bewerk
                                        </button>
                                        <form action="{{ route('team.destroy', $team) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 text-white py-1 px-3 rounded hover:bg-red-600" onclick="return confirm('Weet je zeker dat je dit team wilt verwijderen?')">
                                                Verwijder
                                            </button>
                                        </form>
                                    </div>
                                </div>

                                <!-- Edit Form (hidden by default) -->
                                <div id="edit-form-{{ $team->id }}" class="hidden mt-4">
                                    <form action="{{ route('team.update', $team) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-4">
                                            <label class="block text-sm font-medium text-gray-700">Team Naam</label>
                                            <input type="text" name="team_name" value="{{ $team->name }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                        </div>
                                        <div class="mb-4">
                                            <label class="block text-sm font-medium text-gray-700">Nieuw Logo (optioneel)</label>
                                            <input type="file" name="team_logo" class="mt-1 block w-full" accept="image/*">
                                        </div>
                                        <div class="flex justify-end space-x-2">
                                            <button type="button" onclick="toggleEdit({{ $team->id }})" class="bg-gray-500 text-white py-1 px-3 rounded hover:bg-gray-600">
                                                Annuleren
                                            </button>
                                            <button type="submit" class="bg-green-500 text-white py-1 px-3 rounded hover:bg-green-600">
                                                Opslaan
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <p>Geen teams beschikbaar.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </main>

        <!-- JavaScript for toggle edit form -->
        <script>
            function toggleEdit(teamId) {
                const editForm = document.getElementById(`edit-form-${teamId}`);
                if (editForm.classList.contains('hidden')) {
                    editForm.classList.remove('hidden');
                } else {
                    editForm.classList.add('hidden');
                }
            }
        </script>
    @else
        <div class="container mx-auto py-8 px-4">
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                <strong class="font-bold">Toegang geweigerd!</strong>
                <span class="block sm:inline">Je moet ingelogd zijn om deze pagina te bekijken.</span>
            </div>
        </div>
    @endauth
@endsection
