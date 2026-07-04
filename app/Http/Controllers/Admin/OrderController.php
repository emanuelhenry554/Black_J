<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('user');

        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('numero_commande', 'like', '%' . $request->q . '%')
                  ->orWhereHas('user', fn($sub) => $sub->where('name', 'like', '%' . $request->q . '%'));
            });
        }

        $orders = $query->latest()->paginate(12)->withQueryString();

        return view('pages.admin.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with(['user', 'items', 'payment'])->findOrFail($id);
        return view('pages.admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->statut = $request->statut;
        $order->save();

        return back()->with('success', 'Statut mis à jour.');
    }
}