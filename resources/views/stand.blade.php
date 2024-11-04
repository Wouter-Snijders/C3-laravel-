@extends('layouts.base')

@section('content')
    <div class="container mx-auto mt-8">
        <h1 class="text-2xl font-bold mb-4">Standen</h1>
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="py-2 px-4 border">#</th>
                    <th class="py-2 px-4 border">Team</th>
                    <th class="py-2 px-4 border">Punten</th>
                    <th class="py-2 px-4 border">Doelsaldo</th>
                    <th class="py-2 px-4 border">Winst</th>
                    <th class="py-2 px-4 border">Verlies</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($teams) && $teams->isNotEmpty())
                    @foreach($teams as $index => $team)
                        <tr class="hover:bg-gray-100">
                            <td class="py-2 px-4 border">{{ $index + 1 }}</td>
                            <td class="py-2 px-4 border">
                                @if($team->logo_path)
                                    <img src="{{ asset($team->logo_path) }}" alt="{{ $team->name }} Logo" class="h-8 w-8 inline-block mr-2">
                                @endif
                                {{ $team->name }}
                            </td>
                            <td class="py-2 px-4 border">{{ $team->points }}</td>
                            <td class="py-2 px-4 border">{{ $team->goal_difference }}</td>
                            <td class="py-2 px-4 border">{{ $team->wins }}</td>
                            <td class="py-2 px-4 border">{{ $team->losses }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="py-2 px-4 border text-center">Geen teams beschikbaar</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
@endsection
