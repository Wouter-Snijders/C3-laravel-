<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Wedstrijd;
use Illuminate\Http\Request;

class WedstrijdController extends Controller
{
    // Haal wedstrijden op en toon ze in de view
    public function index()
    {
        // Haal alle teams op
        $teams = Team::all();

        // Haal alle wedstrijden op (of pas dit aan op basis van je behoefte)
        $wedstrijden = Wedstrijd::all();

        // Retourneer de view met de teams en wedstrijden
        return view('home', compact('teams', 'wedstrijden'));
    }

    // Voeg de speelschema methode toe
    public function speelschema()
    {
        // Haal alle wedstrijden op (of pas dit aan op basis van je behoefte)
        $wedstrijden = Wedstrijd::all();

        // Geef de wedstrijden door aan de speelschema view
        return view('speelschema', compact('wedstrijden'));
    }

    // Toon het formulier om een nieuwe wedstrijd te maken
    public function create()
    {
        $teams = Team::all(); // Haal teams op voor het keuze menu
        return view('wedstrijdmaker', compact('teams'));
    }

    // Sla de nieuwe wedstrijd op
    public function store(Request $request)
    {
        $request->validate([
            'team1_id' => 'required|exists:teams,id',
            'team2_id' => 'required|exists:teams,id',
            'wedstrijd_tijd' => 'required|date',
        ]);

        Wedstrijd::create([
            'team1_id' => $request->team1_id,
            'team2_id' => $request->team2_id,
            'wedstrijd_tijd' => $request->wedstrijd_tijd,
        ]);

        return redirect()->route('home')->with('success', 'Wedstrijd succesvol toegevoegd!');
    }

    // Bewerk een bestaande wedstrijd
    public function edit(Wedstrijd $wedstrijd)
    {
        $teams = Team::all(); // Haal teams op voor het keuze menu
        return view('wedstrijden.edit', compact('wedstrijd', 'teams'));
    }

    // Werk een bestaande wedstrijd bij
    public function update(Request $request, Wedstrijd $wedstrijd)
    {
        $request->validate([
            'team1_id' => 'required|exists:teams,id',
            'team2_id' => 'required|exists:teams,id',
            'wedstrijd_tijd' => 'required|date',
        ]);

        $wedstrijd->update([
            'team1_id' => $request->team1_id,
            'team2_id' => $request->team2_id,
            'wedstrijd_tijd' => $request->wedstrijd_tijd,
        ]);

        return redirect()->route('home')->with('success', 'Wedstrijd succesvol bijgewerkt!');
    }

    // Verwijder een wedstrijd
    public function destroy(Wedstrijd $wedstrijd)
    {
        $wedstrijd->delete();
        return redirect()->route('home')->with('success', 'Wedstrijd succesvol verwijderd!');
    }
}
