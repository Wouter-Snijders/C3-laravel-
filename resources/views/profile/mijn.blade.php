@extends('layouts.base')

@section('content')
<div class="text-center mb-8">
    <h1 class="text-3xl font-bold">Mijn advertenties</h1>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
    @foreach($advertenties as $advertentie)
        <div class="bg-white shadow-lg rounded-lg p-6 relative">
            <div class="h-40 bg-gray-200 rounded-lg overflow-hidden relative">
                <img src="{{ Storage::url($advertentie->photo) }}" alt="{{ $advertentie->name }}" class="h-full w-full object-contain">
                <button onclick="toggleFavorite('{{ $advertentie->name }}', {{ $advertentie->price }})" class="absolute top-2 right-2 text-gray-500 hover:text-yellow-500">
                    ★
                </button>
            </div>
            <h2 class="text-xl font-bold mt-4">{{ $advertentie->name }}</h2>
            <p class="text-gray-500">Categorie: {{ $advertentie->category }}</p>
            <p class="text-green-500 font-semibold">€ {{ number_format($advertentie->price, 2) }}</p>
            <button class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 mt-4" onclick="addToCart('{{ $advertentie->name }}', {{ $advertentie->price }})">Toevoegen aan winkelmand</button>
        </div>
    @endforeach
</div>
@endsection
