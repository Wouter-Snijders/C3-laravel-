<x-base-layout>
    @auth
        <main class="container mx-auto py-8 px-4">
            <h1 class="text-2xl font-bold mb-6 text-white">Teamleider Panel</h1>

            <!-- Success Message -->
            @if(session('success'))
                <div class="bg-green-800 border border-green-600 text-green-200 px-4 py-3 rounded relative mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="bg-red-800 border border-red-600 text-red-200 px-4 py-3 rounded relative mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Team Management Section -->
                <div class="bg-gray-800 shadow-md rounded-lg p-6">
                    <h3 class="text-xl font-semibold mb-4 text-white">Team Toevoegen</h3>
                    <form action="{{ route('team.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="team_name" class="block text-sm font-medium text-gray-300">Team Naam</label>
                            <input type="text" name="team_name" id="team_name" class="mt-1 block w-full rounded-md border-gray-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-white bg-gray-700" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-300" for="dropzone">Team Logo (met transparante achtergrond a.u.b)</label>
                            <div class="w-full relative border-2 border-gray-600 border-dashed rounded-lg p-6 bg-gray-700" id="dropzone">
                                <input type="file" name="team_logo" id="file-upload" class="absolute inset-0 w-full h-full opacity-0 z-50" accept="image/*" required />
                                <div class="text-center">
                                    <img class="mx-auto h-12 w-12" src="https://www.svgrepo.com/show/357902/image-upload.svg" alt="">
                                    <h3 class="mt-2 text-sm font-medium text-gray-300">
                                        <label for="file-upload" class="relative cursor-pointer">
                                            <span>Sleep hierheen of</span>
                                            <span class="text-indigo-600"> blader</span>
                                            <span>om te uploaden</span>
                                        </label>
                                    </h3>
                                    <p class="mt-1 text-xs text-gray-400">PNG, JPG, GIF tot 10MB</p>
                                </div>
                                <img src="" class="mt-4 mx-auto max-h-40 hidden" id="preview">
                            </div>
                        </div>
                        <button type="submit" class="bg-green-600 text-white py-2 px-4 rounded hover:bg-yellow-500 transition duration-300">
                            Voeg Team Toe
                        </button>
                    </form>
                </div>
            </div>

            <script>
                var dropzone = document.getElementById('dropzone');

                dropzone.addEventListener('dragover', e => {
                    e.preventDefault();
                    dropzone.classList.add('border-indigo-600');
                });

                dropzone.addEventListener('dragleave', e => {
                    e.preventDefault();
                    dropzone.classList.remove('border-indigo-600');
                });

                dropzone.addEventListener('drop', e => {
                    e.preventDefault();
                    dropzone.classList.remove('border-indigo-600');
                    var file = e.dataTransfer.files[0];
                    document.getElementById('file-upload').files = e.dataTransfer.files; // Set the input file
                    displayPreview(file);
                });

                var input = document.getElementById('file-upload');

                input.addEventListener('change', e => {
                    var file = e.target.files[0];
                    displayPreview(file);
                });

                function displayPreview(file) {
                    var reader = new FileReader();
                    reader.readAsDataURL(file);
                    reader.onload = () => {
                        var preview = document.getElementById('preview');
                        preview.src = reader.result;
                        preview.classList.remove('hidden');
                    };
                }
            </script>

            <!-- Team Overview Section -->
            <div class="bg-gray-800 shadow-md rounded-lg p-6">
                <h3 class="text-xl font-semibold mb-4 text-white">Teams Overzicht</h3>
                <div class="space-y-4">
                    @forelse($teams as $team)
                        <div class="border p-4 rounded-lg bg-gray-700">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-4">
                                    @if($team->logo_path)
                                        <img src="{{ asset($team->logo_path) }}" alt="{{ $team->name }}" class="w-12 h-12 object-cover rounded">
                                    @else
                                        <div class="w-12 h-12 bg-gray-600 rounded flex items-center justify-center">
                                            <span class="text-gray-400">No Logo</span>
                                        </div>
                                    @endif
                                    <span class="font-medium text-white">{{ $team->name }}</span>
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
                                        <label class="block text-sm font-medium text-gray-300">Team Naam</label>
                                        <input type="text" name="team_name" value="{{ $team->name }}" class="mt-1 block w-full rounded-md border-gray-600 shadow-sm text-white bg-gray-700">
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-300">Nieuw Logo (optioneel)</label>
                                        <input type="file" name="team_logo" class="mt-1 block w-full bg-gray-700 text-white" accept="image/*">
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
                        <p class="text-gray-400">Geen teams beschikbaar.</p>
                    @endforelse
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
            <div class="bg-red-800 border border-red-600 text-red-200 px-4 py-3 rounded relative">
                <strong class="font-bold">Toegang geweigerd!</strong>
                <span class="block sm:inline">Je moet ingelogd zijn om deze pagina te bekijken.</span>
            </div>
        </div>
    @endauth
</x-base-layout>
