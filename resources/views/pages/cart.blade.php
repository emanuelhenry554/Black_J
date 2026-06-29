@extends('layouts.app')
@section('title', 'Mon Panier')
@php $hideContactBar = true; @endphp

@section('content')
<div class="max-w-site mx-auto px-px-mobile md:px-px-desktop py-10">

    {{-- Header --}}
    <div class="mb-10 border-b border-outline-variant/30 pb-6">
        <h1 class="font-serif text-h1 text-primary">Mon Panier</h1>
        @if(isset($cartItems) && count($cartItems) > 0)
        <p class="font-sans text-body text-on-surface-variant mt-1">{{ count($cartItems) }} article(s)</p>
        @endif
    </div>

    @if(isset($cartItems) && count($cartItems) > 0)
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

        {{-- Cart items --}}
        <div class="lg:col-span-2 flex flex-col gap-0 divide-y divide-outline-variant/30">
            @foreach($cartItems as $item)
            <div class="flex gap-5 py-6">
                <a href="{{ route('boutique.show', $item['slug'] ?? $item['id']) }}"
                   class="flex-shrink-0 w-24 h-28 bg-surface-container-low overflow-hidden">
                    @if($item['image'] ?? false)
                    <img src="{{ asset('img/'.$item['image']) }}" alt="{{ $item['nom'] }}" class="w-full h-full object-cover">
                    @else
                    <div class="w-full h-full bg-surface-dim"></div>
                    @endif
                </a>
                <div class="flex flex-col gap-2 flex-grow min-w-0">
                    <div class="flex items-start justify-between gap-2">
                        <h3 class="font-serif text-h3 text-primary leading-snug">{{ $item['nom'] }}</h3>
                        <form method="POST" action="{{ route('cart.remove', $item['id']) }}">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-on-surface-variant hover:text-error transition-colors flex-shrink-0" title="Supprimer">
                                <span class="material-symbols-outlined text-[20px]">delete_outline</span>
                            </button>
                        </form>
                    </div>
                    @if($item['couleur'] ?? false)
                    <p class="text-caption uppercase tracking-widest text-on-surface-variant">{{ $item['couleur'] }}</p>
                    @endif
                    <p class="font-sans text-body text-primary font-semibold">{{ number_format($item['prix'], 0, ',', ' ') }} FCFA</p>
                    {{-- Quantity --}}
                    <div class="flex items-center gap-0 mt-auto border border-outline-variant w-fit">
                        <form method="POST" action="{{ route('cart.update', $item['id']) }}">
                            @csrf @method('PATCH')
                            <input type="hidden" name="quantity" value="{{ max(1, $item['quantite'] - 1) }}">
                            <button type="submit" class="w-9 h-9 flex items-center justify-center text-on-surface-variant hover:text-primary hover:bg-surface-container transition-colors">
                                <span class="material-symbols-outlined text-[18px]">remove</span>
                            </button>
                        </form>
                        <span class="w-10 h-9 flex items-center justify-center font-sans text-body text-primary font-semibold border-x border-outline-variant">{{ $item['quantite'] }}</span>
                        <form method="POST" action="{{ route('cart.update', $item['id']) }}">
                            @csrf @method('PATCH')
                            <input type="hidden" name="quantity" value="{{ $item['quantite'] + 1 }}">
                            <button type="submit" class="w-9 h-9 flex items-center justify-center text-on-surface-variant hover:text-primary hover:bg-surface-container transition-colors">
                                <span class="material-symbols-outlined text-[18px]">add</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Order summary --}}
        <div class="lg:col-span-1">
            <div class="bg-surface-container-low p-6 sticky top-32">
                <h2 class="font-serif text-h2 text-primary mb-6 pb-4 border-b border-outline-variant/30">Récapitulatif</h2>
                <div class="flex flex-col gap-3 mb-6">
                    <div class="flex justify-between">
                        <span class="font-sans text-body text-on-surface-variant">Sous-total</span>
                        <span class="font-sans text-body text-primary font-semibold">{{ number_format($subtotal ?? 0, 0, ',', ' ') }} FCFA</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-sans text-body text-on-surface-variant">Livraison</span>
                        <span class="font-sans text-body text-secondary font-semibold">
                            {{ ($subtotal ?? 0) >= 100000 ? 'Gratuite' : '5 000 FCFA' }}
                        </span>
                    </div>
                    <div class="h-px bg-outline-variant/30 my-2"></div>
                    <div class="flex justify-between">
                        <span class="font-serif text-h3 text-primary">Total</span>
                        <span class="font-serif text-h3 text-primary">{{ number_format(($subtotal ?? 0) + (($subtotal ?? 0) >= 100000 ? 0 : 5000), 0, ',', ' ') }} FCFA</span>
                    </div>
                </div>
                <a href="{{ route('checkout.index') }}" class="btn-primary block text-center mb-3">
                    Passer la commande
                </a>
                <a href="{{ route('boutique.index') }}" class="btn-outline block text-center text-sm">
                    Continuer les achats
                </a>
                {{-- Secure payment icons --}}
                <div class="mt-6 pt-4 border-t border-outline-variant/30">
                    <p class="text-caption uppercase tracking-widest text-on-surface-variant text-center mb-3">Paiement sécurisé</p>
                    <div class="flex gap-2 justify-center flex-wrap">
                        <span class="font-sans font-bold italic text-primary text-xs border border-outline-variant px-2 py-0.5">VISA</span>
                        <span class="font-sans text-[10px] font-bold text-primary border border-outline-variant px-2 py-0.5">MASTERCARD</span>
                        <span class="font-sans text-[10px] font-bold text-secondary border border-secondary/50 px-2 py-0.5">WAVE</span>
                        <span class="font-sans text-[10px] font-bold text-primary border border-outline-variant px-2 py-0.5">ORANGE</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @else
    {{-- Empty cart --}}
    <div class="flex flex-col items-center justify-center py-24 text-center">
        <span class="material-symbols-outlined text-7xl text-outline-variant mb-6">shopping_bag</span>
        <h2 class="font-serif text-h2 text-primary mb-3">Votre panier est vide</h2>
        <p class="font-sans text-body text-on-surface-variant mb-8 max-w-sm">Découvrez nos créations et ajoutez vos pièces favorites.</p>
        <a href="{{ route('boutique.index') }}" class="btn-primary">Découvrir la boutique</a>
    </div>
    @endif
</div>
@endsection
