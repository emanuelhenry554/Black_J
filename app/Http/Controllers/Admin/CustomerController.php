<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;

class CustomerController extends Controller
{
    public function index()
    {
        $clients = User::where('role', 'client')
            ->withCount('orders')
            ->latest()
            ->paginate(15);

        return view('pages.admin.customers.index', compact('clients'));
    }

    public function show($id)
    {
        $client = User::findOrFail($id);
        $commandes = Order::where('user_id', $id)
            ->with('items')
            ->latest()
            ->get();

        return view('pages.admin.customers.show', compact('client', 'commandes'));
    }
}
