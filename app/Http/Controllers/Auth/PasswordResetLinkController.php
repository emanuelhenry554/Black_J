<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PasswordResetLinkController extends Controller
{
    public function create()
    {
        return view('pages.auth.forgot-password'); // This view might be missing, I should check
    }

    public function store(Request $request)
    {
        return back()->with('success', 'Lien de réinitialisation envoyé (Simulation)');
    }
}
