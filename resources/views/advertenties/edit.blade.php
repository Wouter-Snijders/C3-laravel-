@extends('layouts.base')

@section('content')
<div class="container mx-auto py-6 flex justify-center">
    <div class="w-full max-w-md">
        <h1 class="text-2xl font-bold mb-4 text-center">Bewerk Advertentie</h1>

        <form action="{{ route('advertenties.update', $advertentie->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT') <!-- HTTP verb aanpassen naar PUT -->

            <div>
                <label for="naam" class="block text-sm font-medium text-gray-700">Naam</label>
                <input type="text" name="naam" id="naam" class="border border-gray-300 p-2 rounded-lg w-full" value="{{ $advertentie->name }}" required>
            </div>

            <div>
                <label for="prijs" class="block text-sm font-medium text-gray-700">Prijs</label>
                <input type="number" name="prijs" id="prijs" class="border border-gray-300 p-2 rounded-lg w-full" value="{{ $advertentie->price }}" required>
            </div>

            <div>
                <label for="categorie" class="block text-sm font-medium text-gray-700">Categorie</label>
                <input type="text" name="categorie" id="categorie" class="border border-gray-300 p-2 rounded-lg w-full" value="{{ $advertentie->category }}" required>
            </div>

            <div>
                <label for="foto" class="block text-sm font-medium text-gray-700">Foto (optioneel)</label>
                <input type="file" name="foto" id="foto" class="border border-gray-300 p-2 rounded-lg w-full">
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 w-full">Bijwerken</button>
        </form>
    </div>
</div>
@endsection
