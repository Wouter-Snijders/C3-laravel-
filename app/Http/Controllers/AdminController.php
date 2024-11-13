<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Constructor om autorisatie toe te voegen
    public function __construct()
    {
        $this->middleware('auth'); // Zorgt ervoor dat de gebruiker ingelogd is
        $this->middleware(function ($request, $next) {
            // Zorgt ervoor dat alleen gebruikers met de 'admin' rank toegang hebben
            if (auth()->check() && auth()->user()->rank === 'admin') {
                return $next($request);
            }

            return redirect()->route('home')->with('error', 'Je hebt geen toegang tot deze pagina.');
        });
    }

    // Toon de lijst met gebruikers in het admin panel
    public function index()
    {
        $users = User::all(); // Haal alle gebruikers op
        return view('admin', compact('users')); // Geef ze door naar de admin view
    }

    // Update de rang van een gebruiker
    public function updateRank(Request $request, $id)
    {
        $user = User::findOrFail($id); // Vind de gebruiker op basis van id
        $user->rank = $request->input('rank'); // Update de rank
        $user->save(); // Sla de gebruiker op

        return redirect()->route('admin')->with('status', 'Rank bijgewerkt.'); // Terug naar admin panel
    }

    // Verwijder een gebruiker
    public function deleteUser($id)
    {
        $user = User::findOrFail($id); // Vind de gebruiker op basis van id
        $user->delete(); // Verwijder de gebruiker

        return redirect()->route('admin')->with('status', 'Gebruiker succesvol verwijderd.'); // Terug naar admin panel
    }
}
