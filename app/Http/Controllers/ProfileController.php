<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        return view('pages.profile');
    }

    public function update(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
            'telephone' => 'nullable|string|max:50',
        ]);

        $user->update($data);

        return back()->with('success', 'Profil mis à jour.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        /** @var User $user */
        $user = Auth::user();

        if (! Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Le mot de passe actuel est incorrect.']);
        }

        $user->update(['password' => Hash::make($request->password)]);

        return back()->with('success', 'Mot de passe modifié.');
    }

    public function orders()
    {
        /** @var User $user */
        $user = Auth::user();
        $orders = $user->orders()->latest()->withCount('items')->paginate(6);

        return view('pages.profile.orders', compact('orders'));
    }

    public function wishlist()
    {
        $wishlist = session('wishlist', []);
        $products = Product::with('category')->whereIn('id', $wishlist)->get();

        return view('pages.profile.wishlist', compact('products'));
    }

    public function toggleWishlist(Product $product)
    {
        $wishlist = session('wishlist', []);

        if (in_array($product->id, $wishlist, true)) {
            $wishlist = array_values(array_diff($wishlist, [$product->id]));
            session(['wishlist' => $wishlist]);

            return back()->with('success', 'Produit retiré des favoris.');
        }

        $wishlist[] = $product->id;
        session(['wishlist' => array_values(array_unique($wishlist))]);

        return back()->with('success', 'Produit ajouté aux favoris.');
    }

    public function removeWishlist(Product $product)
    {
        $wishlist = array_values(array_diff(session('wishlist', []), [$product->id]));
        session(['wishlist' => $wishlist]);

        return back()->with('success', 'Produit retiré des favoris.');
    }

    public function addresses()
    {
        return view('pages.profile.addresses');
    }
}
