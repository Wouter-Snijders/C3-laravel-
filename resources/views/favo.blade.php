@extends('layouts.base')


    @section('content')
    <div class="text-center mb-8"> <!-- Center the title and add margin below -->
        <h1 class="text-3xl font-bold">Mijn Favorieten</h1>
    </div>


    @if(count($favorites) > 0)
        <div class="grid grid-cols-4 gap-6">
            @foreach($favorites as $product)
                <div class="border p-4 rounded-lg shadow-md">
                    <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-auto">
                    <h2 class="text-xl font-bold mt-4">{{ $product->name }}</h2>
                    <p class="text-gray-600">€ {{ number_format($product->price, 2) }}</p>
                    <form method="POST" action="{{ route('cart.add', $product->id) }}">
                        @csrf
                        <button class="bg-green-500 text-white px-4 py-2 mt-4 rounded-lg hover:bg-green-600">Toevoegen aan winkelmand</button>
                    </form>
                </div>
            @endforeach
        </div>
    @else
    <div class="text-center mb-8"> <!-- Center the title and add margin below -->
        <p>Je hebt nog geen favoriete producten toegevoegd.</p>
    </div>
    @endif
@endsection
