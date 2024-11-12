<x-base-layout>
    <div class="container mx-auto mt-8">
        <h1 class="text-2xl font-bold mb-4 text-white">Standen</h1>
        <table class="min-w-full bg-gray-800 border border-gray-600">
            <thead>
                <tr class="bg-gray-700">
                    <th class="py-2 px-4 border text-white">#</th>
                    <th class="py-2 px-4 border text-white">Team</th>
                    <th class="py-2 px-4 border text-white">Punten</th>
                    <th class="py-2 px-4 border text-white">Doelsaldo</th>
                    <th class="py-2 px-4 border text-white">Winst</th>
                    <th class="py-2 px-4 border text-white">Verlies</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($teams) && $teams->isNotEmpty())
                    @foreach($teams as $index => $team)
                        <tr class="hover:bg-gray-600">
                            <td class="py-2 px-4 border text-white">{{ $index + 1 }}</td>
                            <td class="py-2 px-4 border text-white">
                                @if($team->logo_path)
                                    <img src="{{ asset($team->logo_path) }}" alt="{{ $team->name }} Logo" class="h-8 w-8 inline-block mr-2">
                                @endif
                                {{ $team->name }}
                            </td>
                            <td class="py-2 px-4 border text-white">{{ $team->points }}</td>
                            <td class="py-2 px-4 border text-white">{{ $team->goal_difference }}</td>
                            <td class="py-2 px-4 border text-white">{{ $team->wins }}</td>
                            <td class="py-2 px-4 border text-white">{{ $team->losses }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="py-2 px-4 border text-center text-white">Geen teams beschikbaar</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</x-base-layout>
