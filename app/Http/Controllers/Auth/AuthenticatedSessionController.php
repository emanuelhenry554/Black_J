<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    public function create()
    {
        return view('pages.auth.login');
    }

    public function store(Request $request)
    {
        // Just a redirect for frontend demonstration
        return redirect()->route('profile.index')->with('success', 'Connexion réussie (Simulation)');
    }

    public function destroy(Request $request)
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
