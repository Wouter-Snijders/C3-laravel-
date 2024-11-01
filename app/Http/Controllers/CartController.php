<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Product; // Zorg ervoor dat je het Product model importeert
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Voeg een product toe aan de winkelmand
    public function addToCart(Request $request)
    {
        // Verkrijg de huidige gebruiker
        $user = Auth::user();

        // Valideer de invoer
        $request->validate([
            'product_id' => 'required|exists:products,id', // Zorg ervoor dat het product bestaat
            'quantity' => 'required|integer|min:1', // Zorg ervoor dat de hoeveelheid een positief geheel getal is
        ]);

        // Controleer of het product al in de winkelmand staat
        $cartItem = CartItem::where('user_id', $user->id)
            ->where('product_id', $request->input('product_id'))
            ->first();

        if ($cartItem) {
            // Als het product al in de winkelmand staat, werk dan de hoeveelheid bij
            $cartItem->quantity += $request->input('quantity');
            $cartItem->save();
        } else {
            // Voeg een nieuw item toe aan de winkelmand
            CartItem::create([
                'user_id' => $user->id,
                'product_id' => $request->input('product_id'),
                'quantity' => $request->input('quantity'),
            ]);
        }

        return response()->json(['message' => 'Product toegevoegd aan winkelmand.']);
    }

    // Verkrijg de winkelmand items voor de ingelogde gebruiker
    public function getCartItems()
    {
        $user = Auth::user();

        // Haal alle cart items op van de gebruiker
        $cartItems = CartItem::where('user_id', $user->id)->with('product')->get();

        return response()->json($cartItems);
    }
}


