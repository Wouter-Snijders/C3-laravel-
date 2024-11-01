<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function favorieten()
{
    // Haal de favoriete producten op van de ingelogde gebruiker
    $favorites = auth()->user()->favorites()->get();  // Haal de producten die als favoriet zijn gemarkeerd op

    return view('favo', compact('favorites'));
}








}
