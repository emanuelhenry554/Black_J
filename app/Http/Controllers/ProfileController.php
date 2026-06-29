<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return view('pages.profile');
    }

    public function update(Request $request)
    {
        return back()->with('success', 'Profil mis à jour.');
    }

    public function updatePassword(Request $request)
    {
        return back()->with('success', 'Mot de passe modifié.');
    }

    public function orders()
    {
        return view('pages.profile.orders');
    }

    public function wishlist()
    {
        return view('pages.profile.wishlist');
    }

    public function addresses()
    {
        return view('pages.profile.addresses');
    }
}
