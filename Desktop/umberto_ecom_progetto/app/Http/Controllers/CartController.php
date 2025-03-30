<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric',
            'name' => 'required|string',
            'price' => 'required|numeric'
        ]);

        $product = [
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => 1
        ];

        $cart = session()->get('cart', []);

        if (isset($cart[$request->id])) {
            $cart[$request->id]['quantity']++;
        } else {
            $cart[$request->id] = $product;
        }

        session()->put('cart', $cart);
        return response()->json(['message' => 'Prodotto aggiunto al carrello con successo!', 'status' => 'success']);
    }

    public function viewCart()
    {
        $cart = session()->get('cart', []);
        return view('cart', compact('cart'));
    }

    public function removeFromCart(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric'
        ]);
        
        $cart = session()->get('cart', []);
        
        if(isset($cart[$request->id])) {
            unset($cart[$request->id]);
            session()->put('cart', $cart);
            return response()->json(['message' => 'Prodotto rimosso dal carrello con successo!', 'status' => 'success']);
        }
        
        return response()->json(['message' => 'Prodotto non trovato nel carrello.', 'status' => 'error'], 404);
    }

    public function getCartCount()
    {
        $cart = session()->get('cart', []);
        $count = 0;
        foreach($cart as $item) {
            $count += $item['quantity'];
        }
        return response()->json(['count' => $count, 'status' => 'success']);
    }
}
