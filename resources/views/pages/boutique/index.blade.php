@extends('layouts.app')

@section('title', 'Boutique')
@section('meta_description', 'Parcourez toute la collection Blac Joyaux — sacs à main, sacs luxe et pièces prestige.')

@section('content')

{{-- =================== PAGE HEADER =================== --}}
<div class="bg-surface-container-low border-b border-outline-variant/30 py-10 pattern-bg">
    <div class="max-w-site mx-auto px-px-mobile md:px-px-desktop text-center">
        <p class="text-caption uppercase tracking-widest text-secondary font-sans font-semibold mb-3">Blac Joyaux</p>
        <h1 class="font-serif text-h1 text-primary">Notre Boutique</h1>
        <div class="w-8 h-px bg-secondary mx-auto mt-4"></div>
    </div>
</div>

<div class="max-w-site mx-auto px-px-mobile md:px-px-desktop py-10">

    {{-- =================== FILTERS TOOLBAR =================== --}}
    <div class="flex flex-col sm:flex-row gap-4 items-start sm:items-center justify-between mb-8 pb-5 border-b border-outline-variant/30">

        {{-- Category filters (scrollable on mobile) --}}
        <div class="flex gap-2 overflow-x-auto pb-1 -mx-px-mobile px-px-mobile sm:mx-0 sm:px-0 scrollbar-hide">
            @php
                $categories = [
                    ''                    => 'Tout',
                    'do-dominique'        => 'DO - Dominique',
                    'joyaux-de-bla'       => 'Joyaux de Bla',
                    'prestige-collection' => 'Prestige',
                ];
                $currentCat = request('categorie', '');
            @endphp
            @foreach($categories as $slug => $label)
            <a href="{{ route('boutique.index', array_merge(request()->except('categorie', 'page'), $slug ? ['categorie' => $slug] : [])) }}"
               class="whitespace-nowrap flex-shrink-0 px-4 py-2 text-caption uppercase tracking-widest font-sans font-semibold transition-colors
                      {{ $currentCat === $slug ? 'bg-primary text-on-primary' : 'bg-surface-container text-on-surface-variant hover:bg-surface-dim' }}">
                {{ $label }}
            </a>
            @endforeach
        </div>

        {{-- Sort + count --}}
        <div class="flex items-center gap-3 flex-shrink-0">
            <span class="text-caption text-on-surface-variant hidden sm:block">
                {{ $products->total() ?? 0 }} articles
            </span>
            <select name="tri" onchange="window.location.href=this.value"
                    class="bg-surface border border-outline-variant text-sm font-sans text-on-surface px-3 py-2 focus:border-secondary focus:outline-none">
                @php $sorts = ['nouveautes' => 'Nouveautés', 'prix-asc' => 'Prix croissant', 'prix-desc' => 'Prix décroissant']; @endphp
                @foreach($sorts as $val => $label)
                <option value="{{ route('boutique.index', array_merge(request()->all(), ['tri' => $val])) }}"
                        {{ request('tri') === $val ? 'selected' : '' }}>
                    {{ $label }}
                </option>
                @endforeach
            </select>
        </div>
    </div>

    {{-- =================== PRODUCTS GRID =================== --}}
    @if(isset($products) && $products->count() > 0)
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-gutter">
        @foreach($products as $product)
        <div class="product-card group flex flex-col">
            <a href="{{ route('boutique.show', $product->slug ?? $product->id) }}"
               class="block relative aspect-[3/4] overflow-hidden bg-surface-container-low mb-3">
                @if($product->image)
                <img src="{{ asset('img/'.$product->image) }}" alt="{{ $product->nom }}"
                     class="card-img w-full h-full object-cover">
                @else
                <div class="card-img w-full h-full bg-surface-dim flex items-center justify-center">
                    <span class="material-symbols-outlined text-4xl text-outline-variant">shopping_bag</span>
                </div>
                @endif
                {{-- Chips --}}
                <div class="absolute top-3 left-3 flex flex-col gap-1">
                    @if($product->edition_limitee ?? false)
                        <span class="chip-gold">Limitée</span>
                    @endif
                    @if($product->nouveau ?? false)
                        <span class="chip-gold" style="background:#1b1c1c">Nouveau</span>
                    @endif
                </div>
                {{-- Wishlist --}}
                <button class="absolute top-3 right-3 w-8 h-8 bg-surface/80 backdrop-blur-sm flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity hover:bg-surface"
                        title="Ajouter aux favoris">
                    <span class="material-symbols-outlined text-[18px] text-primary">favorite</span>
                </button>
            </a>
            <div class="flex flex-col gap-1 flex-grow">
                <a href="{{ route('boutique.show', $product->slug ?? $product->id) }}">
                    <h3 class="font-serif text-h3 text-primary leading-snug group-hover:text-secondary transition-colors">{{ $product->nom }}</h3>
                </a>
                <p class="text-caption uppercase tracking-widest text-on-surface-variant">{{ $product->matiere ?? '' }}</p>
                <p class="font-sans text-body text-primary font-semibold mt-auto pt-2">{{ number_format($product->prix, 0, ',', ' ') }} FCFA</p>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Pagination --}}
    @if($products->hasPages())
    <div class="flex justify-center gap-2 mt-14">
        @if($products->onFirstPage())
            <span class="w-10 h-10 flex items-center justify-center border border-outline-variant/40 text-on-surface-variant/40 cursor-not-allowed">
                <span class="material-symbols-outlined text-[18px]">chevron_left</span>
            </span>
        @else
            <a href="{{ $products->previousPageUrl() }}" class="w-10 h-10 flex items-center justify-center border border-outline-variant hover:border-secondary text-on-surface-variant hover:text-secondary transition-colors">
                <span class="material-symbols-outlined text-[18px]">chevron_left</span>
            </a>
        @endif

        @foreach($products->getUrlRange(max(1, $products->currentPage()-2), min($products->lastPage(), $products->currentPage()+2)) as $page => $url)
            <a href="{{ $url }}"
               class="w-10 h-10 flex items-center justify-center border text-caption font-sans font-semibold transition-colors
                      {{ $page == $products->currentPage() ? 'bg-primary text-on-primary border-primary' : 'border-outline-variant text-on-surface-variant hover:border-secondary hover:text-secondary' }}">
                {{ $page }}
            </a>
        @endforeach

        @if($products->hasMorePages())
            <a href="{{ $products->nextPageUrl() }}" class="w-10 h-10 flex items-center justify-center border border-outline-variant hover:border-secondary text-on-surface-variant hover:text-secondary transition-colors">
                <span class="material-symbols-outlined text-[18px]">chevron_right</span>
            </a>
        @else
            <span class="w-10 h-10 flex items-center justify-center border border-outline-variant/40 text-on-surface-variant/40 cursor-not-allowed">
                <span class="material-symbols-outlined text-[18px]">chevron_right</span>
            </span>
        @endif
    </div>
    @endif

    @else
    {{-- Empty state --}}
    <div class="flex flex-col items-center justify-center py-24 text-center">
        <span class="material-symbols-outlined text-6xl text-outline-variant mb-6">shopping_bag</span>
        <h3 class="font-serif text-h2 text-primary mb-3">Aucun article trouvé</h3>
        <p class="font-sans text-body text-on-surface-variant mb-8 max-w-sm">Cette catégorie est en cours de préparation. Découvrez nos autres collections.</p>
        <a href="{{ route('boutique.index') }}" class="btn-primary">Voir tous les articles</a>
    </div>
    @endif
</div>
@endsection
