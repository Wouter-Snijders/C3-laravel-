@extends('layouts.base')

@section('content')
<div class="container mx-auto py-8">

    <!-- Countdown to Next Match -->
    <div class="bg-white shadow-md rounded-lg p-6 mb-8 text-center">
        <h2 class="text-2xl font-semibold mb-4">Tijd tot wedstrijd</h2>
        <div class="flex items-center justify-center space-x-8">
            <!-- Club 1 -->
            <div class="text-center">
                <p class="text-xl font-bold">Club 1</p>
                <div class="bg-gray-200 rounded-lg h-32 w-32 mx-auto flex items-center justify-center">
                    <img src="/path/to/club1-logo.png" alt="Club 1 Logo" class="h-24 w-24">
                </div>
            </div>
            <p class="text-xl font-semibold">vs</p>
            <!-- Club 2 -->
            <div class="text-center">
                <p class="text-xl font-bold">Club 2</p>
                <div class="bg-gray-200 rounded-lg h-32 w-32 mx-auto flex items-center justify-center">
                    <img src="/path/to/club2-logo.png" alt="Club 2 Logo" class="h-24 w-24">
                </div>
            </div>
        </div>
    </div>

    <!-- Schedule, Standings, Admin Panel -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Schedule/Inzetten Section -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <h3 class="text-xl font-semibold mb-4">Speel schema / Inzetten</h3>
            <p>Details van speel schema en inzetten komen hier.</p>
        </div>

        <!-- Standings Section -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <h3 class="text-xl font-semibold mb-4">Stand</h3>
            <ul class="space-y-2">
                <li>1. Club 1</li>
                <li>2. Club 2</li>
                <li>3. Club 3</li>
                <li>4. Club 4</li>
                <li>5. Club 5</li>
            </ul>
        </div>

        <!-- Admin Panel Section -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <h3 class="text-xl font-semibold mb-4">Admin Panel</h3>
            <p>Beheer opties komen hier voor admins en teamleiders.</p>
        </div>
    </div>
</div>
@endsection
