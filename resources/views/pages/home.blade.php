@extends('layouts.app')

@section('title', 'Blac Joyaux')
@section('meta_description', 'Blac Joyaux — Maison de maroquinerie de luxe artisanale née à Abidjan. Des sacs d\'exception qui subliment chaque moment.')

@section('content')

{{-- =================== HERO =================== --}}
<section class="relative w-full min-h-[85vh] flex items-center bg-cover bg-center overflow-hidden" style="background-image: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('{{ asset('img/bg.jpeg') }}');">
    <div class="max-w-site mx-auto px-px-mobile md:px-px-desktop w-full grid grid-cols-1 md:grid-cols-2 gap-8 items-center py-20 md:py-32 relative z-10">
        {{-- Text --}}
        <div class="order-2 md:order-1 flex flex-col items-start gap-6">
            <span class="chip-gold">Nouvelle Collection 2025</span>
            <h1 class="font-serif text-display text-white leading-none">
                L'EXCELLENCE<br>PURE.
            </h1>
            <p class="font-sans text-body-lg text-white/80 max-w-md leading-relaxed">
                Des sacs d'exception pour sublimer chaque moment de votre histoire. Artisanat ivoirien, qualité intemporelle.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 w-full sm:w-auto">
                <a href="{{ route('boutique.index') }}" class="btn-primary text-center">Découvrir la boutique</a>
                <a href="{{ route('collections.index') }}" class="btn-outline text-center" style="color: #fff; border-color: #a07830;">Nos collections</a>
            </div>
        </div>
        {{-- Hero Image (Static) --}}
        <div class="order-1 md:order-2 relative h-[55vw] md:h-[65vh] w-full max-h-[600px] overflow-hidden">
            <img src="{{ asset((isset($heroProduct) && $heroProduct->image) ? 'img/'.$heroProduct->image : 'img/Sac-Blac-Joyaux-Bleu-Rose-Intense.jpg') }}"
                 alt="{{ (isset($heroProduct)) ? $heroProduct->nom : 'Blac Joyaux' }}"
                 class="w-full h-full object-cover">

            {{-- Gold accent corner --}}
            <div class="absolute bottom-0 right-0 w-12 h-12 border-b-2 border-r-2 border-secondary z-20 pointer-events-none"></div>
            <div class="absolute top-0 left-0 w-12 h-12 border-t-2 border-l-2 border-secondary z-20 pointer-events-none"></div>
        </div>
    </div>
</section>


{{-- =================== FEATURES BAR =================== --}}
<section class="py-10 bg-surface border-y border-outline-variant/20">
    <div class="max-w-site mx-auto px-px-mobile md:px-px-desktop grid grid-cols-2 md:grid-cols-4 gap-6 divide-x-0 md:divide-x divide-outline-variant/20">
        @foreach([
            ['diamond',        'Matériaux Premium',     'Cuirs sélectionnés pour une qualité incomparable.'],
            ['favorite',       'Fait main avec passion','Chaque sac confectionné avec précision.'],
            ['local_shipping', 'Livraison à Abidjan',   'Livraison rapide dans toute la Côte d\'Ivoire.'],
            ['lock',           'Paiement sécurisé',     'Vos transactions sont 100% protégées.'],
        ] as [$icon, $title, $desc])
        <div class="flex flex-col items-center text-center gap-3 p-4">
            <span class="material-symbols-outlined text-3xl text-secondary">{{ $icon }}</span>
            <h3 class="text-caption uppercase tracking-widest text-primary font-sans font-semibold">{{ $title }}</h3>
            <p class="font-sans text-sm text-on-surface-variant leading-relaxed hidden md:block">{{ $desc }}</p>
        </div>
        @endforeach
    </div>
</section>

{{-- =================== COLLECTIONS GRID =================== --}}
<section class="py-section bg-surface">
    <div class="max-w-site mx-auto px-px-mobile md:px-px-desktop">
        <div class="text-center mb-14">
            <h2 class="font-serif text-h1 text-primary uppercase tracking-widest mb-4">Nos Collections</h2>
            <div class="w-12 h-px bg-secondary mx-auto"></div>
        </div>
        <div class="flex flex-wrap justify-center gap-4 md:gap-gutter">
            @forelse($collections ?? [] as $collection)
            <a href="{{ route('boutique.index', ['categorie' => $collection->slug]) }}"
               class="group relative block aspect-square overflow-hidden bg-surface-container-low w-[45%] sm:w-1/3 md:w-[22%]">
                <div class="w-full h-full bg-surface-dim card-img transition-transform duration-500 group-hover:scale-105">
                    @if($collection->image)
                    <img src="{{ asset('img/'.$collection->image) }}"
                         alt="{{ $collection->nom }}"
                         class="w-full h-full object-cover">
                    @endif
                </div>
                <div class="absolute inset-0 bg-gradient-to-t from-primary/80 via-primary/10 to-transparent"></div>
                <div class="absolute bottom-0 inset-x-0 p-4 md:p-6">
                    <h3 class="font-serif text-h3 text-on-primary mb-1">{{ $collection->nom }}</h3>
                    <span class="text-caption uppercase tracking-widest text-secondary-fixed opacity-0 group-hover:opacity-100 transition-opacity duration-300">Découvrir →</span>
                </div>
            </a>
            @empty
            @foreach([
                ['do-dominique',       'DO - Dominique',  'Collection-Sacs-Blac-Joyaux-Do-Dominique-Ouattara.jpg'],
                ['joyaux-de-bla',      'Joyaux de Bla',   'presentation-sac-blac-joyaux-croco-violet-.jpg'],
                ['prestige-collection','Prestige',         'Sac-a-main-Blac-Joyaux-nouvelle-version-peau-serpent-petit.jpg'],
            ] as [$slug, $label, $img])
            <a href="{{ route('boutique.index', ['categorie' => $slug]) }}" class="group relative block aspect-square overflow-hidden bg-surface-container-low w-[45%] sm:w-1/3 md:w-[22%]">
                <div class="w-full h-full bg-surface-dim card-img transition-transform duration-500 group-hover:scale-105">
                    <img src="{{ asset('img/'.$img) }}" alt="{{ $label }}" class="w-full h-full object-cover">
                </div>
                <div class="absolute inset-0 bg-gradient-to-t from-primary/80 via-primary/10 to-transparent"></div>
                <div class="absolute bottom-0 inset-x-0 p-4 md:p-6">
                    <h3 class="font-serif text-h3 text-on-primary mb-1">{{ $label }}</h3>
                    <span class="text-caption uppercase tracking-widest text-secondary-fixed opacity-0 group-hover:opacity-100 transition-opacity duration-300">Découvrir →</span>
                </div>
            </a>
            @endforeach
            @endforelse
        </div>
    </div>
</section>

{{-- =================== BRAND STORY =================== --}}
<section class="py-section relative overflow-hidden bg-cover bg-center" style="background-image: linear-gradient(rgba(0, 0, 0, 0.35), rgba(0, 0, 0, 0.35)), url('{{ asset('img/bg.jpeg') }}');">
    <div class="max-w-site mx-auto px-px-mobile md:px-px-desktop grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center relative z-10">
        {{-- Story image --}}
        <div class="relative h-[60vw] md:h-[55vh] lg:h-[65vh] max-h-[600px] w-full order-2 lg:order-1">
            @if(isset($storyImage))
            <img src="{{ $storyImage }}" alt="Blac Joyaux atelier" class="absolute inset-0 w-full h-full object-cover">
            @else
            <img src="{{ asset('img/Collection-Sacs-Blac-Joyaux-Do-Dominique-Ouattara.jpg') }}" alt="Collection Blac Joyaux" class="absolute inset-0 w-full h-full object-cover">
            @endif
            <div class="absolute bottom-4 right-4 border border-secondary p-3 bg-surface/90 backdrop-blur-sm">
                <p class="text-caption uppercase tracking-widest text-secondary font-sans font-semibold">Depuis 2020</p>
                <p class="text-caption text-on-surface-variant">Abidjan, CI</p>
            </div>
        </div>
        {{-- Text --}}
        <div class="flex flex-col gap-6 order-1 lg:order-2">
            <span class="text-caption uppercase tracking-widest text-secondary font-sans font-semibold">Blac Joyaux</span>
            <h2 class="font-serif text-h1 text-white leading-tight">
                L'EXCELLENCE<br>IVOIRIENNE.
            </h2>
            <div class="w-8 h-px bg-secondary"></div>
            <p class="font-sans text-body-lg text-white/80 leading-relaxed">
                Née à Abidjan, Blac Joyaux incarne le savoir-faire ivoirien et la passion du détail. Chaque création reflète notre engagement pour le luxe, l'authenticité et l'élégance intemporelle.
            </p>
            <p class="font-sans text-body text-white/70 leading-relaxed">
                Nos artisans sélectionnent les plus beaux cuirs, travaillés avec une précision d'orfèvre, pour créer des pièces destinées à traverser les générations.
            </p>
            <a href="{{ route('about') }}" class="btn-outline self-start" style="color: #fff; border-color: #a07830;">Découvrir notre univers</a>
        </div>
    </div>
</section>

{{-- =================== MODÈLES PHARES =================== --}}
<section class="py-section bg-surface">
    <div class="max-w-site mx-auto px-px-mobile md:px-px-desktop">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-end mb-10 border-b border-outline-variant/30 pb-5 gap-4">
            <h2 class="font-serif text-h2 text-primary">Modèles Phares</h2>
            <a href="{{ route('boutique.index') }}" class="text-caption uppercase tracking-widest text-secondary hover:text-primary transition-colors flex items-center gap-1 font-sans font-semibold">
                Tout voir <span class="material-symbols-outlined text-sm">arrow_forward</span>
            </a>
        </div>

        @php
            $featuredCount = count($featuredProducts ?? []);
        @endphp
        <div class="grid grid-cols-1 {{ $featuredCount === 4 ? 'md:grid-cols-2' : 'md:grid-cols-3' }} gap-8 items-start">
            @forelse($featuredProducts ?? [] as $i => $product)
            @php
                // Logique de disposition dynamique pour un équilibre parfait
                $colSpan = 'md:col-span-1';
                $aspect = 'aspect-square';

                if ($featuredCount === 4) {
                    // Grille 2x2 parfaite et alignée
                    $colSpan = 'md:col-span-1';
                    $aspect = 'aspect-square';
                } elseif ($featuredCount === 3) {
                    // Symétrie parfaite : tous sont égaux
                    $colSpan = 'md:col-span-1';
                    $aspect = 'aspect-square';
                } else {
                    // Disposition classique : seul le premier est mis en avant
                    if ($i === 0) {
                        $colSpan = 'md:col-span-2';
                        $aspect = 'aspect-[4/3]';
                    }
                }
            @endphp
            <div class="product-card group {{ $colSpan }}">
                <a href="{{ route('boutique.show', $product->slug ?? $product->id) }}"
                   class="block relative {{ $aspect }} overflow-hidden bg-surface-container-low mb-4 border border-outline-variant/20 shadow-sm">
                    @if($product->image)
                    <img src="{{ asset('img/'.$product->image) }}" alt="{{ $product->nom }}"
                         class="card-img w-full h-full object-cover">
                    @else
                    <div class="card-img w-full h-full bg-surface-dim flex items-center justify-center">
                        <span class="material-symbols-outlined text-4xl text-outline-variant">shopping_bag</span>
                    </div>
                    @endif
                    @if($product->edition_limitee ?? false)
                    <div class="absolute top-3 left-3"><span class="chip-gold">Édition Limitée</span></div>
                    @endif
                </a>
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="font-serif text-h3 text-primary mb-1 group-hover:text-secondary transition-colors">{{ $product->nom }}</h3>
                        <p class="text-caption uppercase tracking-widest text-on-surface-variant">{{ $product->matiere ?? 'Cuir grainé' }}</p>
                    </div>
                    <span class="font-sans text-body text-primary font-semibold whitespace-nowrap">{{ number_format($product->prix, 0, ',', ' ') }} FCFA</span>
                </div>
            </div>
            @empty
            {{-- 4 images parfaitement alignées (Grille 2x2) --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start col-span-full">
                <div class="product-card group">
                    <a href="{{ route('boutique.index') }}"
                       class="block relative aspect-square overflow-hidden bg-surface-container-low mb-4 border border-outline-variant/20 shadow-sm">
                        <img src="{{ asset('img/Sac-Blac-Joyaux-Vert.jpg') }}"
                             alt="Le Joyau Émeraude"
                             class="card-img w-full h-full object-cover">
                        <div class="absolute top-3 left-3"><span class="chip-gold">Édition Limitée</span></div>
                    </a>
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="font-serif text-h3 text-primary mb-1 group-hover:text-secondary transition-colors">Le Joyau Émeraude</h3>
                            <p class="text-caption uppercase tracking-widest text-on-surface-variant">Cuir grainé</p>
                        </div>
                        <span class="font-sans text-body text-primary font-semibold whitespace-nowrap">150 000 FCFA</span>
                    </div>
                </div>
                <div class="product-card group">
                    <a href="{{ route('boutique.index') }}"
                       class="block relative aspect-square overflow-hidden bg-surface-container-low mb-4 border border-outline-variant/20 shadow-sm">
                        <img src="{{ asset('img/Sac-Blac-Joyaux-Bleu-Rose-Intense.jpg') }}"
                             alt="Rosa Précieuse"
                             class="card-img w-full h-full object-cover">
                    </a>
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="font-serif text-h3 text-primary mb-1 group-hover:text-secondary transition-colors">Rosa Précieuse</h3>
                            <p class="text-caption uppercase tracking-widest text-on-surface-variant">Édition Limitée</p>
                        </div>
                        <span class="font-sans text-body text-primary font-semibold whitespace-nowrap">185 000 FCFA</span>
                    </div>
                </div>
                <div class="product-card group">
                    <a href="{{ route('boutique.index') }}"
                       class="block relative aspect-square overflow-hidden bg-surface-container-low mb-4 border border-outline-variant/20 shadow-sm">
                        <img src="{{ asset('img/Sac-Blac-Joyaux-Rouge-Bordeaux.jpg') }}"
                             alt="L'Héritage Bordeaux"
                             class="card-img w-full h-full object-cover">
                    </a>
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="font-serif text-h3 text-primary mb-1 group-hover:text-secondary transition-colors">L'Héritage Bordeaux</h3>
                            <p class="text-caption uppercase tracking-widest text-on-surface-variant">Classique</p>
                        </div>
                        <span class="font-sans text-body text-primary font-semibold whitespace-nowrap">145 000 FCFA</span>
                    </div>
                </div>
                <div class="product-card group">
                    <a href="{{ route('boutique.index') }}"
                       class="block relative aspect-square overflow-hidden bg-surface-container-low mb-4 border border-outline-variant/20 shadow-sm">
                        <img src="{{ asset('img/Sac-Blac-Joyaux-croco-bleu-ciel.jpg') }}"
                             alt="Bleu Impérial"
                             class="card-img w-full h-full object-cover">
                    </a>
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="font-serif text-h3 text-primary mb-1 group-hover:text-secondary transition-colors">Bleu Impérial</h3>
                            <p class="text-caption uppercase tracking-widest text-on-surface-variant">Croco ciselé</p>
                        </div>
                        <span class="font-sans text-body text-primary font-semibold whitespace-nowrap">195 000 FCFA</span>
                    </div>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</section>

{{-- =================== NEWSLETTER =================== --}}
<section class="py-16 bg-primary text-on-primary pattern-bg">
    <div class="max-w-site mx-auto px-px-mobile md:px-px-desktop text-center">
        <h2 class="font-serif text-h2 text-on-primary mb-3">Rejoignez le Cercle</h2>
        <p class="font-sans text-body text-on-primary/70 mb-8 max-w-md mx-auto">
            Soyez les premiers informés de nos nouvelles créations, événements exclusifs et offres privilèges.
        </p>
        <form method="POST" action="{{ route('newsletter.subscribe') }}" class="flex flex-col sm:flex-row gap-3 max-w-md mx-auto">
            @csrf
            <input type="email" name="email" placeholder="Votre adresse e-mail" required
                   class="flex-grow bg-transparent border border-on-primary/30 focus:border-secondary text-on-primary placeholder-on-primary/40 px-4 py-3 text-body outline-none transition-colors font-sans">
            <button type="submit" class="bg-secondary text-on-secondary font-sans text-caption uppercase tracking-widest font-semibold px-6 py-3 hover:bg-secondary-fixed transition-colors whitespace-nowrap">
                S'inscrire
            </button>
        </form>
    </div>
</section>

@endsection
