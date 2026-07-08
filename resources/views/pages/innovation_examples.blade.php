@extends('layouts.app')

@section('title', 'Innovation — Exemples')
@section('meta_description', 'Exemples de sacs inspirants par Blac Joyaux')

@section('content')
<div class="bg-surface border-b border-outline-variant/30 py-10">
    <div class="max-w-site mx-auto px-px-mobile md:px-px-desktop text-center">
        <p class="text-caption uppercase tracking-widest text-secondary font-sans font-semibold mb-3">Avant-Garde</p>
        <h1 class="font-serif text-h1 text-primary">L'Innovation au service du Luxe</h1>
        <div class="w-8 h-px bg-secondary mx-auto mt-4"></div>
    </div>
</div>

<div class="max-w-site mx-auto px-px-mobile md:px-px-desktop py-16 md:py-24">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
        <div class="relative">
            <div class="relative w-full overflow-hidden shadow-luxury">
                <img src="{{ asset('img/ino1.jpeg') }}" alt="Innovation Blac Joyaux" class="w-full h-auto block">
            </div>
            <div class="absolute -bottom-6 -right-6 w-48 h-48 border-4 border-secondary -z-10 hidden md:block"></div>
        </div>
        <div class="flex flex-col gap-6">
            <h2 class="font-serif text-h2 text-primary leading-tight"> Fusionner l'héritage et la modernité.</h2>
            <p class="font-sans text-body text-on-surface-variant leading-relaxed">
                Pour Blac Joyaux, innover c'est sublimer. Nous repoussons les limites de la maroquinerie traditionnelle en intégrant des matériaux durables et des coupes architecturales, comme notre signature trapèze, pour créer des pièces qui transcendent le temps.
            </p>
            <p class="font-sans text-body text-on-surface-variant leading-relaxed">
                Nous croyons en un luxe conscient, où la résilience des traditions africaines rencontre l'exigence du design contemporain.
            </p>
            <div class="flex gap-8 pt-4">
                <div class="flex flex-col">
                    <span class="text-h3 font-serif text-secondary">Éthique</span>
                    <span class="text-caption uppercase tracking-widest text-on-surface-variant font-semibold">Luxe Durable</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-h3 font-serif text-secondary">Design</span>
                    <span class="text-caption uppercase tracking-widest text-on-surface-variant font-semibold">Coupes Architecturales</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="max-w-site mx-auto px-px-mobile md:px-px-desktop py-12 md:py-20">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @foreach(($products ?? collect())->take(3) as $product)
        <a href="{{ route('boutique.show', $product->slug ?? $product->id) }}" class="group bg-surface border border-outline-variant/30 p-4 rounded shadow-card text-left">
            <div class="aspect-[4/5] overflow-hidden rounded mb-3">
                <img src="{{ $product->image_url ?? asset('img/sacs-blac-joyaux.jpeg') }}" alt="{{ $product->nom ?? 'Produit' }}" class="w-full h-full object-cover">
            </div>
            <div>
                <h3 class="font-serif text-h4 text-primary">{{ $product->nom ?? 'Produit' }}</h3>
                <p class="text-sm text-on-surface-variant">{{ number_format($product->prix ?? 0, 0, ',', ' ') }} FCFA</p>
            </div>
        </a>
        @endforeach
    </div>
</div>

@endsection
