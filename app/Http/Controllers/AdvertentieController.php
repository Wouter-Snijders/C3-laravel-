<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Advertentie;
use Illuminate\Support\Facades\Storage;

class AdvertentieController extends Controller
{
    // Toont de pagina om een advertentie aan te maken
    public function create()
    {
        return view('advertenties.create');
    }

    // Slaat de nieuwe advertentie op en stuurt door naar de home pagina
    public function store(Request $request)
    {
        // Validatie voor de advertentie-informatie
        $request->validate([
            'naam' => 'required|string|max:255',
            'prijs' => 'required|numeric',
            'categorie' => 'required|string|max:255',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Maak een nieuwe advertentie aan
        $advertentie = new Advertentie();
        $advertentie->name = $request->naam;
        $advertentie->price = $request->prijs;
        $advertentie->category = $request->categorie;

        // Opslaan van de foto
        if ($request->hasFile('foto')) {
            $advertentie->photo = $request->file('foto')->store('public/advertenties');
        }

        // Voeg de user_id toe
        $advertentie->user_id = auth()->id(); // Zorg ervoor dat de gebruiker ingelogd is

        $advertentie->save();

        // Doorsturen naar de pagina met recente advertenties met een succesbericht
        return redirect()->route('home')->with('success', 'Advertentie succesvol geplaatst!');
    }

    // Laad alle advertenties en toont deze op de home pagina met zoekfunctionaliteit
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Haal advertenties op met optie om te filteren op zoekterm
        $advertenties = Advertentie::with('user') // Eager load de gebruiker
            ->when($search, function ($query) use ($search) {
                return $query->where('name', 'like', "%{$search}%");
            })
            ->get();

        return view('home', compact('advertenties'));
    }

    // Toont advertenties die door de ingelogde gebruiker zijn geplaatst
    public function myAdvertisements()
    {
        $this->authorize('viewAny', Advertentie::class);

        $advertenties = Advertentie::where('user_id', auth()->id())->get(); // Haal advertenties op van de ingelogde gebruiker
        return view('advertenties.mijn_advertenties', compact('advertenties')); // Geef de advertenties door aan de view
    }

    // Toont de pagina om een advertentie aan te passen
    public function edit($id)
    {
        $advertentie = Advertentie::findOrFail($id);
        return view('advertenties.edit', compact('advertentie'));
    }

    // Update de advertentie
    public function update(Request $request, $id)
    {
        $advertentie = Advertentie::findOrFail($id);

        // Validatie voor de advertentie-informatie
        $request->validate([
            'naam' => 'required|string|max:255',
            'prijs' => 'required|numeric',
            'categorie' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $advertentie->name = $request->naam;
        $advertentie->price = $request->prijs;
        $advertentie->category = $request->categorie;

        // Als er een nieuwe foto is geüpload, vervang de oude
        if ($request->hasFile('foto')) {
            // Verwijder de oude foto
            Storage::delete($advertentie->photo);
            // Sla de nieuwe foto op
            $advertentie->photo = $request->file('foto')->store('public/advertenties');
        }

        $advertentie->save();

        return redirect()->route('mijn.advertenties')->with('success', 'Advertentie succesvol bijgewerkt!');
    }

    // Verwijder de advertentie
    public function destroy($id)
    {
        $advertentie = Advertentie::findOrFail($id);
        Storage::delete($advertentie->photo); // Verwijder de foto van de opslag
        $advertentie->delete(); // Verwijder de advertentie

        return redirect()->route('mijn.advertenties')->with('success', 'Advertentie succesvol verwijderd!');
    }
}
