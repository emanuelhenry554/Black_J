<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BoutiqueController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\InventoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController as AdminAuthenticatedSessionController;
use App\Http\Middleware\EnsureAdmin;

// =============================================
// PAGES PUBLIQUES
// =============================================
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/a-propos', [HomeController::class, 'about'])->name('about');
Route::get('/innovation', [HomeController::class, 'innovation'])->name('innovation');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/newsletter', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

// =============================================
// BOUTIQUE
// =============================================
Route::get('/boutique', [BoutiqueController::class, 'index'])->name('boutique.index');
Route::get('/boutique/{slug}', [BoutiqueController::class, 'show'])->name('boutique.show');
Route::get('/collections', [BoutiqueController::class, 'collections'])->name('collections.index');

// =============================================
// PANIER
// =============================================
Route::get('/panier', [CartController::class, 'index'])->name('cart.index');
Route::post('/panier/ajouter', [CartController::class, 'add'])->name('cart.add');
Route::patch('/panier/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/panier/{id}', [CartController::class, 'remove'])->name('cart.remove');

// =============================================
// COMMANDE / PAIEMENT
// =============================================
Route::middleware('auth')->group(function () {
    Route::get('/commande', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/commande', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('/commande/simulation/{numero}', [CheckoutController::class, 'simulation'])->name('checkout.simulation');
    Route::post('/commande/simuler-succes/{numero}', [CheckoutController::class, 'simulerSucces'])->name('checkout.simulerSucces');
    Route::get('/commande/confirmation/{numero}', [CheckoutController::class, 'confirmation'])->name('checkout.confirmation');
});

// =============================================
// AUTH (si tu utilises Laravel Breeze/Sanctum)
// =============================================
Route::middleware('guest')->group(function () {
    Route::get('/connexion', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/connexion', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'store']);
    Route::get('/inscription', [App\Http\Controllers\Auth\RegisteredUserController::class, 'create'])->name('register');
    Route::post('/inscription', [App\Http\Controllers\Auth\RegisteredUserController::class, 'store']);
    Route::get('/mot-de-passe-oublie', [App\Http\Controllers\Auth\PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('/mot-de-passe-oublie', [App\Http\Controllers\Auth\PasswordResetLinkController::class, 'store'])->name('password.email');
});

Route::post('/deconnexion', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])->name('logout');

// =============================================
// ESPACE CLIENT (connecté)
// =============================================
Route::middleware('auth')->group(function () {
    Route::get('/profil', [ProfileController::class, 'index'])->name('profile.index');
    Route::patch('/profil', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profil/mot-de-passe', [ProfileController::class, 'updatePassword'])->name('profile.password');
    Route::get('/profil/commandes', [ProfileController::class, 'orders'])->name('profile.orders');
    Route::get('/profil/favoris', [ProfileController::class, 'wishlist'])->name('profile.wishlist');
    Route::post('/profil/favoris/{product}', [ProfileController::class, 'toggleWishlist'])->name('profile.wishlist.toggle');
    Route::delete('/profil/favoris/{product}', [ProfileController::class, 'removeWishlist'])->name('profile.wishlist.remove');
    Route::get('/profil/adresses', [ProfileController::class, 'addresses'])->name('profile.addresses');
});

// =============================================
// ADMINISTRATION
// =============================================
Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest:admin')->group(function () {
        Route::get('/connexion', [AdminAuthenticatedSessionController::class, 'create'])->name('login');
        Route::post('/connexion', [AdminAuthenticatedSessionController::class, 'store'])->name('login.store');
    });

    Route::post('/deconnexion', [AdminAuthenticatedSessionController::class, 'destroy'])->name('logout');

    Route::middleware([EnsureAdmin::class])->group(function () {

        // Dashboard
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // Commandes
        Route::get('/commandes', [OrderController::class, 'index'])->name('orders.index');
        Route::get('/commandes/{id}', [OrderController::class, 'show'])->name('orders.show');
Route::patch('/commandes/{id}/statut', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
Route::post('/commandes/{id}/statut', [OrderController::class, 'updateStatus'])->name('orders.updateStatus.post');

        // Catalogue / Produits
        Route::get('/produits', [ProductController::class, 'index'])->name('products.index');
        Route::get('/produits/creer', [ProductController::class, 'create'])->name('products.create');
        Route::post('/produits', [ProductController::class, 'store'])->name('products.store');
        Route::get('/produits/{id}/modifier', [ProductController::class, 'edit'])->name('products.edit');
        Route::patch('/produits/{id}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('/produits/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

        // Inventaire
        Route::get('/inventaire', [InventoryController::class, 'index'])->name('inventory.index');
        Route::patch('/inventaire/{id}', [InventoryController::class, 'update'])->name('inventory.update');

        // Clients
        Route::get('/clients', [CustomerController::class, 'index'])->name('customers.index');
        Route::get('/clients/{id}', [CustomerController::class, 'show'])->name('customers.show');
    });
});
