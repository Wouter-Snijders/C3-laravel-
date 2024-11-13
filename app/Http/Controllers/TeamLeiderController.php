<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;

class TeamLeiderController extends Controller
{
    // Constructor om autorisatie toe te voegen
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            // Controleer of de gebruiker is ingelogd en of de gebruiker een 'teamleider' of 'admin' is
            if (auth()->check() && (auth()->user()->rank === 'teamleider' || auth()->user()->rank === 'admin')) {
                return $next($request);
            }

            // Als de gebruiker geen toegangsrechten heeft, stuur terug naar home
            return redirect()->route('home')->with('error', 'Je hebt geen toegang tot deze pagina.');
        });
    }

    // Toon alle teams
    public function index()
    {
        $teams = Team::all();
        return view('teamleider', compact('teams'));
    }

    // Voeg een nieuw team toe
    public function store(Request $request)
    {
        $request->validate([
            'team_name' => 'required|max:255',
            'team_logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('team_logo')) {
            // Sla de afbeelding op in public/images
            $logoPath = 'images/' . time() . '.' . $request->team_logo->extension();
            $request->team_logo->move(public_path('images'), $logoPath);

            // Maak het nieuwe team aan
            Team::create([
                'name' => $request->team_name,
                'logo_path' => $logoPath
            ]);

            return redirect()->back()->with('success', 'Team succesvol toegevoegd!');
        }

        return back()->with('error', 'Er ging iets mis bij het uploaden van het logo.');
    }

    // Verwijder een team
    public function destroy(Team $team)
    {
        if ($team->logo_path) {
            // Verwijder de afbeelding uit de public/images map
            if (file_exists(public_path($team->logo_path))) {
                unlink(public_path($team->logo_path));
            }
        }
        $team->delete();
        return redirect()->back()->with('success', 'Team succesvol verwijderd!');
    }

    // Werk een team bij
    public function update(Request $request, Team $team)
    {
        $request->validate([
            'team_name' => 'required|max:255',
            'team_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $team->name = $request->team_name;

        if ($request->hasFile('team_logo')) {
            // Verwijder de oude afbeelding
            if ($team->logo_path) {
                if (file_exists(public_path($team->logo_path))) {
                    unlink(public_path($team->logo_path));
                }
            }
            // Sla de nieuwe afbeelding op in public/images
            $team->logo_path = 'images/' . time() . '.' . $request->team_logo->extension();
            $request->team_logo->move(public_path('images'), $team->logo_path);
        }

        $team->save();
        return redirect()->back()->with('success', 'Team succesvol bijgewerkt!');
    }
}
