<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'commandes' => Order::count(),
            'revenus'   => Order::sum('total'),
            'clients'   => User::where('role', 'client')->count(),
            'produits'  => Product::count(),
        ];

        $recentOrders = Order::with('user')->latest()->limit(5)->get();

        $lowStockProducts = Collection::make();

        // Commandes par mois
        $commandesParMois = Order::select(
            DB::raw('MONTH(created_at) as mois'),
            DB::raw('count(*) as total')
        )
        ->whereYear('created_at', date('Y'))
        ->groupBy('mois')
        ->orderBy('mois')
        ->get();

        // Commandes par semaine
        $commandesParSemaine = Order::select(
            DB::raw('WEEK(created_at) as semaine'),
            DB::raw('count(*) as total')
        )
        ->where('created_at', '>=', now()->subWeeks(12))
        ->groupBy('semaine')
        ->orderBy('semaine')
        ->get();

        // Répartition par statut
        $commandesParStatut = Order::select('statut', DB::raw('count(*) as total'))
            ->groupBy('statut')
            ->pluck('total', 'statut');

        // Répartition par mode de paiement
        $commandesParPaiement = Order::select('payment_method', DB::raw('count(*) as total'))
            ->groupBy('payment_method')
            ->pluck('total', 'payment_method');

        // Top produit
        $topProduit = DB::table('order_items')
            ->select('product_name', DB::raw('SUM(quantite) as total_vendu'))
            ->groupBy('product_name')
            ->orderByDesc('total_vendu')
            ->first();

        return view('pages.admin.dashboard', compact(
            'stats',
            'recentOrders',
            'lowStockProducts',
            'commandesParMois',
            'commandesParSemaine',
            'commandesParStatut',
            'commandesParPaiement',
            'topProduit'
        ));
    }
}
