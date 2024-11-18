<?php

namespace App\Http\Controllers;

use App\Models\Wedstrijd;
use App\Models\Team;
use App\Models\User; // Voeg het User model toe
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
        // Haal de teams en scheidsrechters op
        $teams = Team::all();
        $scheidsrechters = User::where('rank', 'scheidsrechter')->get(); // Haal scheidsrechters op uit de users tabel
        $wedstrijden = Wedstrijd::with('team1', 'team2')->get();

        // Geef teams, scheidsrechters en wedstrijden door aan de view
        return view('wedstrijdmaker', compact('teams', 'scheidsrechters', 'wedstrijden'));
    }

    // Opslaan van nieuwe wedstrijd
    public function store(Request $request)
    {
        // Valideer de aanvraag
        $request->validate([
            'team1_id' => 'required|exists:teams,id',
            'team2_id' => 'required|exists:teams,id',
            'scheidsrechter' => 'required|exists:users,name', // Validatie voor scheidsrechter naam
            'location' => 'required|string',
            'wedstrijd_tijd' => 'required|date',
        ]);

        // Maak een nieuwe wedstrijd aan
        Wedstrijd::create([
            'team1_id' => $request->team1_id,
            'team2_id' => $request->team2_id,
            'scheidsrechter' => $request->scheidsrechter, // Voeg scheidsrechter naam toe
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
        $scheidsrechters = User::where('rank', 'scheidsrechter')->get(); // Haal scheidsrechters op uit de users tabel

        // Zet wedstrijd_tijd om naar een Carbon object en formatteer naar 'Y-m-d\TH:i' voor datetime-local
        $wedstrijd_tijd = Carbon::parse($wedstrijd->wedstrijd_tijd)->format('Y-m-d\TH:i');

        // Geef wedstrijd, teams en scheidsrechters door naar de view
        return view('wedstrijdbewerken', compact('wedstrijd', 'teams', 'scheidsrechters', 'wedstrijd_tijd'));
    }

    // Wedstrijd bijwerken
    public function update(Request $request, $id)
    {
        // Valideer de aanvraag
        $request->validate([
            'team1_id' => 'required|exists:teams,id',
            'team2_id' => 'required|exists:teams,id',
            'scheidsrechter' => 'required|exists:users,name', // Validatie voor scheidsrechter naam
            'location' => 'required|string',
            'wedstrijd_tijd' => 'required|date',
        ]);

        // Zoek de specifieke wedstrijd en werk bij
        $wedstrijd = Wedstrijd::findOrFail($id);
        $wedstrijd->update([
            'team1_id' => $request->team1_id,
            'team2_id' => $request->team2_id,
            'scheidsrechter' => $request->scheidsrechter, // Voeg scheidsrechter naam toe
            'location' => $request->location,
            'wedstrijd_tijd' => $request->wedstrijd_tijd,
        ]);

        // Redirect naar het speelschema met een succesmelding
        return redirect()->route('wedstrijdmaker')->with('success', 'Wedstrijd succesvol bijgewerkt!');
    }

    // Wedstrijd verwijderen
    public function destroy($id)
    {
        $wedstrijd = Wedstrijd::findOrFail($id);
        $wedstrijd->delete();

        // Redirect naar het speelschema met een succesmelding
        return redirect()->route('wedstrijdmaker')->with('success', 'Wedstrijd succesvol verwijderd!');
    }
}
