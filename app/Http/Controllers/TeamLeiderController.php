<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Wedstrijd;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TeamLeiderController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (auth()->check() && (auth()->user()->rank === 'teamleider' || auth()->user()->rank === 'admin')) {
                return $next($request);
            }
            return redirect()->route('home')->with('error', 'Je hebt geen toegang tot deze pagina.');
        });
    }

    public function index()
    {
        $teams = Team::all();
        return view('teamleider', compact('teams'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'team_name' => 'required|max:255',
            'team_logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('team_logo')) {
            $logoPath = 'images/' . time() . '.' . $request->team_logo->extension();
            $request->team_logo->move(public_path('images'), $logoPath);

            // Nieuw team aanmaken
            $newTeam = Team::create([
                'name' => $request->team_name,
                'logo_path' => $logoPath
            ]);

            // Genereer wedstrijden
            $this->generateMatchesForNewTeam($newTeam);

            return redirect()->back()->with('success', 'Team succesvol toegevoegd en wedstrijden gegenereerd!');
        }

        return back()->with('error', 'Er ging iets mis bij het uploaden van het logo.');
    }

    public function destroy(Team $team)
    {
        if ($team->logo_path) {
            if (file_exists(public_path($team->logo_path))) {
                unlink(public_path($team->logo_path));
            }
        }
        $team->delete();
        return redirect()->back()->with('success', 'Team succesvol verwijderd!');
    }

    public function update(Request $request, Team $team)
    {
        $request->validate([
            'team_name' => 'required|max:255',
            'team_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $team->name = $request->team_name;

        if ($request->hasFile('team_logo')) {
            if ($team->logo_path && file_exists(public_path($team->logo_path))) {
                unlink(public_path($team->logo_path));
            }
            $team->logo_path = 'images/' . time() . '.' . $request->team_logo->extension();
            $request->team_logo->move(public_path('images'), $team->logo_path);
        }

        $team->save();
        return redirect()->back()->with('success', 'Team succesvol bijgewerkt!');
    }

    /**
     * Genereer wedstrijden voor een nieuw team
     *
     * @param Team $newTeam
     */
    private function generateMatchesForNewTeam(Team $newTeam)
    {
        $existingTeams = Team::where('id', '!=', $newTeam->id)->get();
        $currentDate = Carbon::now();

        foreach ($existingTeams as $team) {
            // Wedstrijd 1: Nieuwe team speelt thuis
            Wedstrijd::create([
                'team1_id' => $newTeam->id,
                'team2_id' => $team->id,
                'scheidsrechter' => 'Nog niet toegewezen', // Pas dit aan indien nodig
                'location' => $newTeam->name . ' Stadion',
                'wedstrijd_tijd' => $currentDate->addDays(7)->toDateTimeString()
            ]);

            // Wedstrijd 2: Bestaande team speelt thuis
            Wedstrijd::create([
                'team1_id' => $team->id,
                'team2_id' => $newTeam->id,
                'scheidsrechter' => 'Nog niet toegewezen', // Pas dit aan indien nodig
                'location' => $team->name . ' Stadion',
                'wedstrijd_tijd' => $currentDate->addDays(7)->toDateTimeString()
            ]);

            $currentDate->addDays(1); // Verhoog de datum voor de volgende wedstrijden
        }
    }
}
