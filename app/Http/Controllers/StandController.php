<?php

namespace App\Http\Controllers;

use App\Models\Team; // Zorg ervoor dat je het juiste model importeert
use Illuminate\Http\Request;

class StandController extends Controller
{
    // Methode om de stand te tonen
    public function index()
    {
        // Haal alle teams op
        $teams = Team::all();

        // Geef de stand view weer met de teams
        return view('stand', compact('teams'));
    }
}
