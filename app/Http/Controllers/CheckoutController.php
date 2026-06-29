<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('pages.checkout');
    }

    public function process(Request $request)
    {
        return redirect()->route('checkout.confirmation', ['numero' => 'BJ-001'])
                         ->with('success', 'Commande confirmée !');
    }

    public function confirmation($numero)
    {
        return view('pages.checkout_confirmation', compact('numero'));
    }
}
