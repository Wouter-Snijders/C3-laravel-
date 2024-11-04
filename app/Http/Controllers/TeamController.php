<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeamController extends Controller
{
    public function index()
    {
        $teams = Team::all();
        return view('admin', compact('teams'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'team_name' => 'required|max:255',
            'team_logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $logoPath = $request->file('team_logo')->store('team-logos', 'public');

        Team::create([
            'name' => $request->team_name,
            'logo_path' => $logoPath
        ]);

        return redirect()->back()->with('success', 'Team succesvol toegevoegd!');
    }

    public function destroy(Team $team)
    {
        if($team->logo_path) {
            Storage::disk('public')->delete($team->logo_path);
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

        if($request->hasFile('team_logo')) {
            if($team->logo_path) {
                Storage::disk('public')->delete($team->logo_path);
            }
            $team->logo_path = $request->file('team_logo')->store('team-logos', 'public');
        }

        $team->save();
        return redirect()->back()->with('success', 'Team succesvol bijgewerkt!');
    }
}
