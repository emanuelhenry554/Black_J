<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    protected function getCart(): array
    {
        return session('cart', []);
    }

    protected function clearCart(): void
    {
        session()->forget(['cart', 'cart_count']);
    }

    public function index()
    {
        $cartItems = $this->getCart();

        if (empty($cartItems)) {
            return redirect()->route('cart.index')->with('error', 'Votre panier est vide.');
        }

        $subtotal = array_reduce($cartItems, fn($sum, $item) => $sum + ($item['prix'] * $item['quantite']), 0);
        $shipping = $subtotal >= 100000 ? 0 : 5000;
        $total = $subtotal + $shipping;

        return view('pages.checkout', compact('cartItems', 'subtotal', 'shipping', 'total'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'nom'           => 'required|string|max:255',
            'prenom'        => 'required|string|max:255',
            'email'         => 'required|email',
            'telephone'     => 'required|string|max:50',
            'adresse'       => 'required|string|max:1000',
            'commune'       => 'required|string|max:255',
            'ville'         => 'required|string|max:255',
            'mode_paiement' => 'required|string',
            'notes'         => 'nullable|string|max:1000',
        ]);

        $cartItems = $this->getCart();

        if (empty($cartItems)) {
            return redirect()->route('cart.index')->with('error', 'Votre panier est vide.');
        }

        $subtotal = array_reduce($cartItems, fn($sum, $item) => $sum + ($item['prix'] * $item['quantite']), 0);
        $shipping = $subtotal >= 100000 ? 0 : 5000;
        $total    = $subtotal + $shipping;

        // Mise à jour de l'adresse de l'utilisateur
        if (Auth::check()) {
            $user = Auth::user();
            $newAddress = $request->adresse . ' - ' . $request->commune . ' - ' . $request->ville;
            // Mettre à jour l'adresse de l'utilisateur pour éviter les doublons
            if ($user->address !== $newAddress) {
                $user->address = $newAddress;
                $user->save();
            }
        }

        // Création de la commande
        $order = Order::create([
            'user_id'            => Auth::id(),
            'numero_commande'    => 'BJ-' . now()->format('YmdHis') . '-' . rand(100, 999),
            'subtotal'           => $subtotal,
            'taxes'              => 0,
            'total'              => $total,
            'statut'             => 'en_attente',
            'shipping_name'      => $request->nom . ' ' . $request->prenom,
            'shipping_email'     => $request->email,
            'shipping_telephone' => $request->telephone,
            'shipping_address'   => $request->adresse . ' - ' . $request->commune . ' - ' . $request->ville,
            'payment_method'     => $request->mode_paiement,
            'notes'              => $request->notes,
        ]);

      foreach ($cartItems as $item) {
    OrderItem::create([
        'order_id'      => $order->id,
        'product_id'    => $item['product_id'],
        'product_name'  => $item['nom'],
        'couleur'       => $item['couleur'] ?? null,
        'taille'        => null,
        'quantite'      => $item['quantite'],
        'prix_unitaire' => $item['prix'],
        'total'         => $item['prix'] * $item['quantite'],
    ]);
}

        // Création du paiement simulé
       Payment::create([
    'order_id'       => $order->id,
    'transaction_id' => 'TXN-' . strtoupper(uniqid()),
    'montant'        => $total,
    'status'         => 'en_attente',
    'mode_paiement'  => $request->mode_paiement,
    'details'        => null,
]);

        $this->clearCart();

        // Redirection selon le mode de paiement
        if ($request->mode_paiement === 'especes') {
            return redirect()->route('checkout.confirmation', ['numero' => $order->numero_commande])
                             ->with('success', 'Commande confirmée ! Paiement en espèces à la livraison.');
        }

        return redirect()->route('checkout.simulation', ['numero' => $order->numero_commande]);
    }

    public function simulation($numero)
    {
        $order = Order::where('numero_commande', $numero)->with('payment')->firstOrFail();
        return view('pages.checkout_simulation', compact('order'));
    }

    public function simulerSucces($numero)
    {
        $order = Order::where('numero_commande', $numero)->with('payment')->firstOrFail();

        $order->update(['statut' => 'paye']);
        $order->payment->update(['payment_status' => 'confirme']);

        return redirect()->route('checkout.confirmation', ['numero' => $numero])
                         ->with('success', 'Paiement confirmé !');
    }

    public function confirmation($numero)
    {
        $order = Order::where('numero_commande', $numero)
                      ->with(['items', 'payment'])
                      ->firstOrFail();

        $whatsappMessage = urlencode(
            "Bonjour Blac Joyaux ! J'ai passé la commande *{$order->numero_commande}* d'un montant de *" .
            number_format($order->total, 0, ',', ' ') . " FCFA*. Pouvez-vous confirmer ? Merci 🙏"
        );

        $whatsappNumber = '2250000000000';

        return view('pages.checkout_confirmation', compact('order', 'whatsappMessage', 'whatsappNumber'));
    }
}
