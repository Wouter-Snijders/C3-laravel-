<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Wedstrijd;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

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

            // Maak het nieuwe team aan
            $newTeam = Team::create([
                'name' => $request->team_name,
                'logo_path' => $logoPath
            ]);

            // Genereer wedstrijden
            $this->generateWedstrijdenForNewTeam($newTeam);

            return redirect()->back()->with('success', 'Team en wedstrijden succesvol toegevoegd!');
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
            if ($team->logo_path) {
                if (file_exists(public_path($team->logo_path))) {
                    unlink(public_path($team->logo_path));
                }
            }
            $team->logo_path = 'images/' . time() . '.' . $request->team_logo->extension();
            $request->team_logo->move(public_path('images'), $team->logo_path);
        }

        $team->save();
        return redirect()->back()->with('success', 'Team succesvol bijgewerkt!');
    }

    private function generateWedstrijdenForNewTeam(Team $newTeam)
{
    $teams = Team::where('id', '!=', $newTeam->id)->get(); // Haal alle andere teams op
    $scheidsrechters = User::where('rank', 'scheidsrechter')->get(); // Haal scheidsrechters op

    if ($scheidsrechters->isEmpty()) {
        // Geen scheidsrechters gevonden
        return;
    }

    foreach ($teams as $opponent) {
        // Eerste wedstrijd: Thuiswedstrijd voor $newTeam
        $this->createWedstrijd($newTeam, $opponent, $scheidsrechters, 'thuis');

        // Tweede wedstrijd: Thuiswedstrijd voor $opponent
        $this->createWedstrijd($opponent, $newTeam, $scheidsrechters, 'thuis');
    }
}

private function createWedstrijd($homeTeam, $awayTeam, $scheidsrechters, $wedstrijdType)
{
    $randomScheidsrechter = $scheidsrechters->random(); // Kies een willekeurige scheidsrechter
    $startOfWeek = Carbon::now()->startOfWeek(); // Maandag van deze week
    $endOfWeek = Carbon::now()->endOfWeek(); // Zondag van deze week

    // Kies een willekeurige datum tussen maandag en zondag van deze week
    $wedstrijdDatum = Carbon::createFromTimestamp(rand($startOfWeek->timestamp, $endOfWeek->timestamp));

    // Stel een tijd in tussen 08:00 en 15:00 uur met afgeronde uren
    $wedstrijdTijd = $wedstrijdDatum->setHour(rand(8, 15))->setMinute(0); // Afgerond op een heel uur

    // Maak de wedstrijd aan
    Wedstrijd::create([
        'team1_id' => $homeTeam->id,
        'team2_id' => $awayTeam->id,
        'scheidsrechter' => $randomScheidsrechter->name,
        'location' => 'Stadion ' . $homeTeam->name, // Het stadion van het thuisteam
        'wedstrijd_tijd' => $wedstrijdTijd
    ]);
    }
}

