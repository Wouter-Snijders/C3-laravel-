<?php

namespace App\Http\Controllers;

use App\Models\Wedstrijd;
use App\Models\Team;
use Illuminate\Http\Request;
use Carbon\Carbon;

class WedstrijdController extends Controller
{
    // Toon het speelschema met alle wedstrijden
    public function speelschema()
    {
        // Haal alle wedstrijden op met de bijbehorende teams
        $wedstrijden = Wedstrijd::with('team1', 'team2')->get();
        return view('speelschema', compact('wedstrijden')); // geef wedstrijden door naar de view
    }

    // Toon het formulier voor het aanmaken van een nieuwe wedstrijd
    public function create()
    {
        // Haal de teams en wedstrijden op
        $teams = Team::all();
        $wedstrijden = Wedstrijd::with('team1', 'team2')->get();

        // Geef teams en wedstrijden door aan de view
        return view('wedstrijdmaker', compact('teams', 'wedstrijden'));
    }

    // Opslaan van nieuwe wedstrijd
    public function store(Request $request)
    {
        // Valideer de aanvraag
        $request->validate([
            'team1_id' => 'required|exists:teams,id',
            'team2_id' => 'required|exists:teams,id',
            'location' => 'required|string',
            'wedstrijd_tijd' => 'required|date',
        ]);

        // Maak een nieuwe wedstrijd aan
        Wedstrijd::create([
            'team1_id' => $request->team1_id,
            'team2_id' => $request->team2_id,
            'location' => $request->location,
            'wedstrijd_tijd' => $request->wedstrijd_tijd,
        ]);

        // Redirect terug naar de wedstrijdmaker pagina met een succesmelding
        return redirect()->route('wedstrijdmaker')->with('success', 'Wedstrijd succesvol toegevoegd!');
    }

    // Wedstrijd bewerken
    public function edit($id)
    {
        $wedstrijd = Wedstrijd::findOrFail($id);
        $teams = Team::all(); // Haal alle teams op voor de dropdowns

        // Zet wedstrijd_tijd om naar een Carbon object en formatteer naar 'Y-m-d\TH:i' voor datetime-local
        $wedstrijd_tijd = Carbon::parse($wedstrijd->wedstrijd_tijd)->format('Y-m-d\TH:i');

        // Geef wedstrijd en teams door naar de view
        return view('wedstrijdbewerken', compact('wedstrijd', 'teams', 'wedstrijd_tijd'));
    }

    // Wedstrijd bijwerken
    public function update(Request $request, $id)
    {
        // Valideer de aanvraag
        $request->validate([
            'team1_id' => 'required|exists:teams,id',
            'team2_id' => 'required|exists:teams,id',
            'location' => 'required|string',
            'wedstrijd_tijd' => 'required|date',
        ]);

        // Zoek de specifieke wedstrijd en werk bij
        $wedstrijd = Wedstrijd::findOrFail($id);
        $wedstrijd->update([
            'team1_id' => $request->team1_id,
            'team2_id' => $request->team2_id,
            'location' => $request->location,
            'wedstrijd_tijd' => $request->wedstrijd_tijd,
        ]);

        // Redirect naar het speelschema met een succesmelding
        return redirect()->route('wedstrijdmaker')->with('success', 'Wedstrijd succesvol bijgewerkt!');
    }

    // Wedstrijd verwijderen
    public function destroy($id)
    {
        // Zoek de specifieke wedstrijd en verwijder deze
        $wedstrijd = Wedstrijd::findOrFail($id);
        $wedstrijd->delete();

        // Redirect naar de wedstrijdmaker met een succesmelding
        return redirect()->route('wedstrijdmaker')->with('success', 'Wedstrijd succesvol verwijderd!');
    }
}
