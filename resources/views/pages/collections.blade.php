@extends('layouts.app')

@section('title', 'Nos Collections — Blac Joyaux')
@section('meta_description', 'DO - Dominique, Joyaux de Bla, Prestige — les trois univers de la maison Blac Joyaux.')

@section('content')

{{-- PAGE HEADER --}}
<div class="bg-surface-container-low border-b border-outline-variant/30 py-10 pattern-bg">
    <div class="max-w-site mx-auto px-px-mobile md:px-px-desktop text-center">
        <p class="text-caption uppercase tracking-widest text-secondary font-sans font-semibold mb-3">L'Univers</p>
        <h1 class="font-serif text-h1 text-primary">Nos Collections</h1>
        <div class="w-8 h-px bg-secondary mx-auto mt-4"></div>
    </div>
</div>

{{-- COLLECTIONS GRID --}}
<div class="max-w-site mx-auto px-px-mobile md:px-px-desktop py-16 md:py-24">

    @php
    $fallbackImages = [
        'do-dominique'        => 'Collection-Sacs-Blac-Joyaux-Do-Dominique-Ouattara.jpg',
        'joyaux-de-bla'       => 'presentation-sac-blac-joyaux-croco-violet-.jpg',
        'prestige-collection' => 'Sac-a-main-Blac-Joyaux-nouvelle-version-peau-serpent-petit.jpg',
    ];

    $descriptions = [
        'do-dominique'        => "La collection signature. Silhouettes fortes, cuirs nobles et identite africaine assumee.",
        'joyaux-de-bla'       => "Pieces audacieuses aux couleurs eclatantes. Chaque sac est un bijou de caractere.",
        'prestige-collection' => "L'excellence a l'etat pur. Matieres rares, finitions orfevrees, editions ultra-limitees.",
    ];
    @endphp

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 md:gap-10 max-w-5xl mx-auto">
        @foreach($categories as $category)
        @php
            $img  = $category->image ?: ($fallbackImages[$category->slug] ?? 'sacs-blac-joyaux.jpg');
            $desc = $descriptions[$category->slug] ?? 'Decouvrez notre selection exclusive.';
            $count = $category->products()->count();
        @endphp
        <a href="{{ route('boutique.index', ['categorie' => $category->slug]) }}" class="group block">

            {{-- Image --}}
            <div class="relative aspect-[3/4] overflow-hidden bg-surface-container mb-5 shadow-luxury border border-outline-variant/30">
                <img src="{{ asset('img/'.$img) }}"
                     alt="{{ $category->nom }}"
                     class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">

                {{-- Overlay hover --}}
                <div class="absolute inset-0 bg-primary/0 group-hover:bg-primary/50 transition-colors duration-400 flex items-center justify-center">
                    <span class="font-serif text-on-primary text-h3 opacity-0 group-hover:opacity-100 transition-opacity duration-300 px-4 text-center">
                        Voir la collection
                    </span>
                </div>

                {{-- Badge produits --}}
                @if($count > 0)
                <div class="absolute top-3 right-3 bg-surface/90 backdrop-blur-sm px-2 py-1">
                    <span class="text-caption uppercase tracking-widest text-primary font-sans font-semibold text-[10px]">
                        {{ $count }} modele{{ $count > 1 ? 's' : '' }}
                    </span>
                </div>
                @endif

                {{-- Coin decoratif --}}
                <div class="absolute bottom-0 left-0 w-8 h-8 border-b-2 border-l-2 border-secondary"></div>
            </div>

            {{-- Texte --}}
            <div class="text-center px-2">
                <h3 class="font-serif text-h3 text-primary group-hover:text-secondary transition-colors mb-2">
                    {{ $category->nom }}
                </h3>
                <p class="font-sans text-sm text-on-surface-variant leading-relaxed mb-3">
                    {{ $desc }}
                </p>
                <span class="text-caption uppercase tracking-widest text-secondary font-sans font-semibold flex items-center justify-center gap-1">
                    Explorer <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </span>
            </div>

        </a>
        @endforeach
    </div>
</div>

{{-- CTA --}}
<section class="py-16 bg-primary text-on-primary pattern-bg">
    <div class="max-w-site mx-auto px-px-mobile md:px-px-desktop text-center">
        <h2 class="font-serif text-h2 text-on-primary mb-3">Vous ne savez pas par ou commencer ?</h2>
        <p class="font-sans text-body text-on-primary/70 mb-8 max-w-md mx-auto">
            Parcourez l'ensemble de notre boutique et filtrez selon vos envies.
        </p>
        <a href="{{ route('boutique.index') }}" class="btn-primary">
            Voir tous les sacs
        </a>
    </div>
</section>

@endsection
