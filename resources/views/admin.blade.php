<x-base-layout>
    <x-slot name="title">Admin Panel</x-slot>
    <main class="container mx-auto py-8">
        <h1 class="text-3xl font-bold text-gray-200 mb-6">Gebruikersbeheer</h1>
        <table class="min-w-full bg-gray-800 text-gray-100 shadow-md rounded-lg overflow-hidden">
            <thead>
                <tr class="bg-gray-700">
                    <th class="px-4 py-2 text-left">Naam</th>
                    <th class="px-4 py-2 text-left">Email</th>
                    <th class="px-4 py-2 text-left">Rang</th>
                    <th class="px-4 py-2 text-left">Acties</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    @if($user->id !== auth()->id()) <!-- Filter uitgelogde gebruiker -->
                        <tr class="bg-gray-900 border-b border-gray-700 hover:bg-gray-700 transition-colors">
                            <td class="px-4 py-2">{{ $user->name }}</td>
                            <td class="px-4 py-2">{{ $user->email }}</td>
                            <td class="px-4 py-2">
                                <form action="{{ route('admin.updateRank', $user->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <select name="rank" class="bg-gray-800 border border-gray-600 text-gray-100 px-2 py-1 rounded focus:outline-none focus:ring-2 focus:ring-gray-500" onchange="this.form.submit()">
                                        <option value="user" {{ $user->rank === 'user' ? 'selected' : '' }}>User</option>
                                        <option value="teamleider" {{ $user->rank === 'teamleider' ? 'selected' : '' }}>Teamleider</option>
                                        <option value="scheidsrechter" {{ $user->rank === 'scheidsrechter' ? 'selected' : '' }}>Scheidsrechter</option>
                                    </select>
                                </form>
                            </td>
                            <td class="px-4 py-2">
                                <form action="{{ route('admin.deleteUser', $user->id) }}" method="POST" onsubmit="return confirm('Weet je zeker dat je deze gebruiker wilt verwijderen?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 transition-colors">Verwijderen</button>
                                </form>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </main>
</x-base-layout>
