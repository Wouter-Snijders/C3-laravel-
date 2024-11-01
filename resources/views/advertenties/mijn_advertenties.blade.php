@extends('layouts.base')

@section('content')
<div class="container mx-auto py-6">
    <h1 class="text-2xl font-bold mb-4">Mijn Advertenties</h1>

    @foreach($advertenties as $advertentie)
        <div class="bg-white shadow-lg rounded-lg p-6 mb-4 flex items-center">
            <!-- Afbeelding van de advertentie -->
            <div class="flex-shrink-0">
                <img src="{{ Storage::url($advertentie->photo) }}" alt="{{ $advertentie->name }}" class="w-32 h-32 object-cover rounded-lg">
            </div>
            <div class="ml-4 flex-grow">
                <h2 class="text-xl font-bold">{{ $advertentie->name }}</h2>
                <p class="text-gray-500">Categorie: {{ $advertentie->category }}</p>
                <p class="text-green-500 font-semibold">€ {{ number_format($advertentie->price, 2) }}</p>
            </div>

            <div class="mt-4 flex-shrink-0">
                <a href="{{ route('advertenties.edit', $advertentie->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Bewerken</a>
                <form action="{{ route('advertenties.destroy', $advertentie->id) }}" method="POST" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">Verwijderen</button>
                </form>
            </div>
        </div>
    @endforeach
</div>
@endsection
