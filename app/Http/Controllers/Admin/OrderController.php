<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        return view('pages.admin.orders.index');
    }

    public function show($id)
    {
        return view('pages.admin.orders.show');
    }

    public function updateStatus(Request $request, $id)
    {
        return back()->with('success', 'Statut mis à jour.');
    }
}
