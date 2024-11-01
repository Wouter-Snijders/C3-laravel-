@extends('layouts.base')

@section('content')
<div class="container mx-auto py-6 flex justify-center">
    <div class="w-full max-w-md"> <!-- Een maximale breedte ingesteld voor de form -->
        <h1 class="text-2xl font-bold mb-4 text-center">Plaats een nieuwe advertentie</h1>

        <form action="{{ route('advertenties.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div>
                <label for="naam" class="block text-sm font-medium text-gray-700">Naam</label>
                <input type="text" name="naam" id="naam" class="border border-gray-300 p-2 rounded-lg w-full" required>
            </div>

            <div>
                <label for="prijs" class="block text-sm font-medium text-gray-700">Prijs</label>
                <input type="number" name="prijs" id="prijs" class="border border-gray-300 p-2 rounded-lg w-full" required>
            </div>

            <div>
                <label for="categorie" class="block text-sm font-medium text-gray-700">Categorie</label>
                <input type="text" name="categorie" id="categorie" class="border border-gray-300 p-2 rounded-lg w-full" required>
            </div>

            <div>
                <label for="foto" class="block text-sm font-medium text-gray-700">Foto</label>
                <input type="file" name="foto" id="foto" class="border border-gray-300 p-2 rounded-lg w-full" required>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 w-full">Plaats Advertentie</button>
        </form>
    </div>
</div>
@endsection
