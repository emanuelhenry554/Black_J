<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        return view('pages.cart');
    }

    public function add(Request $request)
    {
        return back()->with('success', 'Produit ajouté au panier !');
    }

    public function update(Request $request, $id)
    {
        return back()->with('success', 'Panier mis à jour.');
    }

    public function remove($id)
    {
        return back()->with('success', 'Produit retiré du panier.');
    }
}
