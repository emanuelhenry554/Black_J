<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('pages.auth.register');
    }

    public function store(Request $request)
    {
        // Just a redirect for frontend demonstration
        return redirect()->route('login')->with('success', 'Compte créé avec succès (Simulation)');
    }
}
