@extends('layouts.app')

@section('title', 'Blac Joyaux')
@section('meta_description', 'Blac Joyaux — Maison de maroquinerie de luxe artisanale née à Abidjan. Des sacs d\'exception qui subliment chaque moment.')

@section('content')

{{-- =================== HERO =================== --}}
<section class="relative w-full min-h-[85vh] flex items-center justify-center overflow-hidden">
    {{-- Carousel en fond --}}
    <div id="hero-carousel" class="absolute inset-0 w-full h-full">
        @php
            $heroSlides = [
                'bg.jpeg',
                'Sac-Blac-Joyaux-Bleu-Rose-Intense.jpg',
                'Collection-Sacs-Blac-Joyaux-Do-Dominique-Ouattara.jpg',
                'Sac-Blac-Joyaux-Vert.jpg',
                'Sac-Blac-Joyaux-croco-bleu-ciel.jpg',
            ];
        @endphp
        @foreach($heroSlides as $index => $slide)
        <div class="hero-slide absolute inset-0 w-full h-full bg-cover bg-center transition-opacity duration-1000 ease-in-out {{ $index === 0 ? 'opacity-100' : 'opacity-0' }}"
             style="background-image: url('{{ asset('img/'.$slide) }}');"></div>
        @endforeach
        {{-- Voile sombre pour la lisibilité du texte --}}
        <div class="absolute inset-0 bg-black/40"></div>
    </div>

    {{-- Texte centré --}}
    <div class="max-w-site mx-auto px-px-mobile md:px-px-desktop w-full py-20 md:py-32 relative z-10 flex flex-col items-center text-center gap-6">
        <span class="chip-gold">Nouvelle Collection 2025</span>
        <h1 class="font-serif text-display text-white leading-none">
            L'EXCELLENCE<br>PURE.
        </h1>
        <p class="font-sans text-body-lg text-white/80 max-w-md leading-relaxed mx-auto">
            Des sacs d'exception pour sublimer chaque moment de votre histoire. Artisanat ivoirien, qualité intemporelle.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 w-full sm:w-auto justify-center">
            <a href="{{ route('boutique.index') }}" class="btn-primary text-center">Découvrir la boutique</a>
            <a href="{{ route('collections.index') }}" class="btn-outline text-center" style="color: #fff; border-color: #a07830;">Nos collections</a>
        </div>
    </div>
</section>

@push('scripts')
<script>
    (function () {
        const slides = document.querySelectorAll('#hero-carousel .hero-slide');
        if (!slides.length) return;
        let current = 0;
        setInterval(() => {
            slides[current].classList.remove('opacity-100');
            slides[current].classList.add('opacity-0');
            current = (current + 1) % slides.length;
            slides[current].classList.remove('opacity-0');
            slides[current].classList.add('opacity-100');
        }, 5000);
    })();
</script>
@endpush

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
        <div class="flex flex-wrap justify-center gap-4 md:gap-6">
            @forelse($collections ?? [] as $collection)
            <a href="{{ route('boutique.index', ['categorie' => $collection->slug]) }}"
               class="group relative block aspect-[4/5] overflow-hidden bg-surface-container-low w-[calc(50%-0.5rem)] md:w-[calc(25%-1.125rem)]">
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
            <a href="{{ route('boutique.index', ['categorie' => $slug]) }}" class="group relative block aspect-[4/5] overflow-hidden bg-surface-container-low w-[calc(50%-0.5rem)] md:w-[calc(25%-1.125rem)]">
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

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-8 items-start">
            @forelse($featuredProducts ?? [] as $i => $product)
            <div class="product-card group">
                <a href="{{ route('boutique.show', $product->slug ?? $product->id) }}"
                   class="block relative aspect-square overflow-hidden bg-surface-container-low mb-4">
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
            @foreach([
                ['Sac-Blac-Joyaux-Vert.jpg',              'Le Joyau Émeraude',     'Cuir grainé',    '150 000', true],
                ['Sac-Blac-Joyaux-Bleu-Rose-Intense.jpg', 'Rosa Précieuse',        'Édition Limitée','185 000', false],
                ['Sac-Blac-Joyaux-Rouge-Bordeaux.jpg',    "L'Héritage Bordeaux",   'Classique',      '145 000', false],
                ['Sac-Blac-Joyaux-croco-bleu-ciel.jpg',   'Bleu Impérial',         'Croco ciselé',   '195 000', false],
            ] as [$img, $label, $matiere, $prix, $limitee])
            <div class="product-card group">
                <a href="{{ route('boutique.index') }}"
                   class="block relative aspect-square overflow-hidden bg-surface-container-low mb-4">
                    <img src="{{ asset('img/'.$img) }}"
                         alt="{{ $label }}"
                         class="card-img w-full h-full object-cover">
                    @if($limitee)
                    <div class="absolute top-3 left-3"><span class="chip-gold">Édition Limitée</span></div>
                    @endif
                </a>
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="font-serif text-h3 text-primary mb-1 group-hover:text-secondary transition-colors">{{ $label }}</h3>
                        <p class="text-caption uppercase tracking-widest text-on-surface-variant">{{ $matiere }}</p>
                    </div>
                    <span class="font-sans text-body text-primary font-semibold whitespace-nowrap">{{ $prix }} FCFA</span>
                </div>
            </div>
            @endforeach
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
