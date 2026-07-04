<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected function getCart(): array
    {
        return session('cart', []);
    }

    protected function saveCart(array $cart): void
    {
        session(['cart' => $cart]);
        session(['cart_count' => array_sum(array_column($cart, 'quantite'))]);
    }

    public function index()
    {
        $cartItems = $this->getCart();
        $subtotal = array_reduce($cartItems, fn($sum, $item) => $sum + ($item['prix'] * $item['quantite']), 0);

        return view('pages.cart', compact('cartItems', 'subtotal'));
    }

    public function add(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required|exists:products,id',
            'color_id' => 'nullable|integer|exists:product_colors,id',
            'quantity' => 'nullable|integer|min:1',
        ]);

        $product = Product::with(['images', 'colors'])->findOrFail($data['product_id']);
        $quantity = $data['quantity'] ?? 1;
        $color = $product->colors->firstWhere('id', $data['color_id']) ?? null;

        $key = $product->id . '-' . ($color->id ?? '0');
        $cart = $this->getCart();

        if (isset($cart[$key])) {
            $cart[$key]['quantite'] += $quantity;
        } else {
            $cart[$key] = [
                'id' => $key,
                'product_id' => $product->id,
                'slug' => $product->slug,
                'nom' => $product->nom,
                'prix' => $product->prix,
                'quantite' => $quantity,
                'image' => optional($product->images->first())->path ?? $product->image,
                'couleur' => $color->name ?? null,
                'color_id' => $color->id ?? null,
            ];
        }

        $this->saveCart($cart);

        return redirect()->route('cart.index')->with('success', 'Produit ajouté au panier !');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = $this->getCart();

        if (! isset($cart[$id])) {
            return back()->with('error', 'Produit introuvable dans le panier.');
        }

        $cart[$id]['quantite'] = $request->quantity;
        $this->saveCart($cart);

        return back()->with('success', 'Panier mis à jour.');
    }

    public function remove($id)
    {
        $cart = $this->getCart();

        if (isset($cart[$id])) {
            unset($cart[$id]);
            $this->saveCart($cart);
        }

        return back()->with('success', 'Produit retiré du panier.');
    }
}
