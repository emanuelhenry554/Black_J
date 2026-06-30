@extends('layouts.app')

@section('title', $product->nom ?? 'Produit')
@section('meta_description', $product->description_courte ?? 'Découvrez ce sac d\'exception chez Blac Joyaux.')

@section('content')

<div class="max-w-site mx-auto px-px-mobile md:px-px-desktop py-8 md:py-14">

    {{-- Breadcrumb --}}
    <nav class="flex items-center gap-2 text-caption text-on-surface-variant mb-8 flex-wrap">
        <a href="{{ route('home') }}" class="hover:text-secondary transition-colors">Accueil</a>
        <span class="material-symbols-outlined text-[14px]">chevron_right</span>
        <a href="{{ route('boutique.index') }}" class="hover:text-secondary transition-colors">Boutique</a>
        @if(isset($product->categorie))
        <span class="material-symbols-outlined text-[14px]">chevron_right</span>
        <a href="{{ route('boutique.index', ['categorie' => $product->categorie->slug ?? '']) }}" class="hover:text-secondary transition-colors">{{ $product->categorie->nom ?? '' }}</a>
        @endif
        <span class="material-symbols-outlined text-[14px]">chevron_right</span>
        <span class="text-primary font-semibold">{{ $product->nom ?? 'Produit' }}</span>
    </nav>

    {{-- =================== PRODUCT MAIN =================== --}}
    <div class="grid grid-cols-1 md:grid-cols-12 gap-8 md:gap-gutter items-start">

        {{-- LEFT: Images --}}
        <div class="md:col-span-7 flex flex-col gap-4">
            {{-- Main image --}}
            <div class="relative aspect-[4/5] overflow-hidden bg-surface-container-low group" id="main-image-container">
                @if(isset($product->images) && $product->images->isNotEmpty())
                    <img id="main-image"
                         src="{{ asset('img/'.$product->images->first()->path) }}"
                         alt="{{ $product->nom }}"
                         class="w-full h-full object-cover transition-opacity duration-300">
                @elseif(isset($product->image))
                    <img id="main-image"
                         src="{{ asset('img/'.$product->image) }}"
                         alt="{{ $product->nom }}"
                         class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full bg-surface-dim flex items-center justify-center">
                        <span class="material-symbols-outlined text-6xl text-outline-variant">shopping_bag</span>
                    </div>
                @endif
                {{-- Gold corner accents --}}
                <div class="absolute bottom-0 right-0 w-8 h-8 border-b border-r border-secondary pointer-events-none"></div>
            </div>

            {{-- Thumbnail strip --}}
            @if(isset($product->images) && $product->images->count() > 1)
            <div class="grid grid-cols-4 gap-3">
                @foreach($product->images as $i => $img)
                <button onclick="changeMainImage('{{ asset('img/'.$img->path) }}')"
                        class="aspect-square overflow-hidden bg-surface-container-low border-2 transition-colors
                               {{ $i === 0 ? 'border-secondary' : 'border-transparent hover:border-outline-variant' }}">
                    <img src="{{ asset('img/'.$img->path) }}" alt="" class="w-full h-full object-cover">
                </button>
                @endforeach
            </div>
            @endif
        </div>

        {{-- RIGHT: Product info --}}
        <div class="md:col-span-5 md:sticky md:top-32 flex flex-col gap-6">

            {{-- Header --}}
            <div>
                @if(isset($product->categorie))
                <p class="text-caption uppercase tracking-widest text-secondary font-sans font-semibold mb-2">{{ $product->categorie->nom }}</p>
                @endif
                <h1 class="font-serif text-h1 text-primary mb-4">{{ $product->nom ?? 'Nom du produit' }}</h1>
                <p class="font-serif text-h2 text-secondary">{{ number_format($product->prix ?? 150000, 0, ',', ' ') }} FCFA</p>
            </div>

            {{-- Description --}}
            <p class="font-sans text-body text-on-surface-variant leading-relaxed border-t border-outline-variant/30 pt-5">
                {{ $product->description ?? 'Sac d\'exception confectionné à la main par nos artisans. Cuir de première qualité, finitions soignées, quincaillerie dorée.' }}
            </p>

            {{-- Options --}}
            <div class="flex flex-col gap-5 border-t border-b border-outline-variant/30 py-6">

                {{-- Color Palette --}}
                @if(isset($product->colors) && $product->colors->isNotEmpty())
                <div class="flex flex-col gap-3">
                    <span class="text-caption uppercase tracking-widest font-sans font-semibold text-on-surface block">Choisir la couleur</span>
                    <div class="flex gap-3 flex-wrap" id="color-palette">
                        @foreach($product->colors as $color)
                        <button
                            title="{{ $color->name }}"
                            data-id="{{ $color->id }}"
                            data-image="{{ $color->image_path ? asset('img/'.$color->image_path) : '' }}"
                            style="background-color: {{ $color->hex }}"
                            class="color-swatch w-8 h-8 rounded-full border-2 transition-all hover:scale-110 focus:outline-none {{ $loop->first ? 'border-secondary' : 'border-transparent' }}"
                            onclick="selectColor(this)">
                        </button>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Détails --}}
                <div class="grid grid-cols-2 gap-3">
                    @if($product->matiere ?? false)
                    <div>
                        <p class="text-caption uppercase tracking-widest text-on-surface-variant font-sans">Matière</p>
                        <p class="font-sans text-body text-primary font-semibold">{{ $product->matiere }}</p>
                    </div>
                    @endif
                    @if($product->dimensions ?? false)
                    <div>
                        <p class="text-caption uppercase tracking-widest text-on-surface-variant font-sans">Dimensions</p>
                        <p class="font-sans text-body text-primary font-semibold">{{ $product->dimensions }}</p>
                    </div>
                    @endif
                </div>
            </div>

            {{-- Stock --}}
            @if(isset($product->stock))
            <div class="flex items-center gap-2">
                @if($product->stock > 5)
                    <span class="w-2 h-2 rounded-full bg-green-500"></span>
                    <span class="text-caption uppercase tracking-widest text-green-700 font-sans font-semibold">En stock</span>
                @elseif($product->stock > 0)
                    <span class="w-2 h-2 rounded-full bg-secondary"></span>
                    <span class="text-caption uppercase tracking-widest text-secondary font-sans font-semibold">Plus que {{ $product->stock }} disponible(s)</span>
                @else
                    <span class="w-2 h-2 rounded-full bg-error"></span>
                    <span class="text-caption uppercase tracking-widest text-error font-sans font-semibold">Rupture de stock</span>
                @endif
            </div>
            @endif

            {{-- CTA --}}
            <div class="flex flex-col gap-3">
                @if(!isset($product->stock) || $product->stock > 0)
                <form method="POST" action="{{ route('cart.add') }}">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id ?? '' }}">
                    <input type="hidden" name="color_id" id="selected-color-id" value="{{ $product->colors->first()->id ?? '' }}">
                    <input type="hidden" name="quantity" value="1">
                    <button type="submit" class="btn-primary w-full text-center flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">shopping_bag</span>
                        Ajouter au panier
                    </button>
                </form>
                @else
                <button disabled class="w-full py-4 bg-surface-dim text-on-surface-variant text-caption uppercase tracking-widest font-sans font-semibold cursor-not-allowed">
                    Indisponible
                </button>
                @endif
                <button class="btn-outline w-full flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">favorite</span>
                    Ajouter aux favoris
                </button>
            </div>

            {{-- WhatsApp CTA --}}
            <a href="https://wa.me/2250584889918?text=Bonjour, je suis intéressé(e) par {{ urlencode($product->nom ?? 'votre produit') }}"
               target="_blank"
               class="flex items-center gap-3 border border-green-500/40 p-4 hover:bg-green-50 transition-colors">
                <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1. la la lalaL de l'image" class="w-full h-full object-cover"></svg>
                <div>
                    <p class="text-caption uppercase tracking-widest font-sans font-semibold text-green-700">Commander via WhatsApp</p>
                    <p class="text-sm font-sans text-on-surface-variant">Réponse en moins de 24h</p>
                </div>
            </a>
        </div>
    </div>

    {{-- =================== PRODUCT DETAILS ACCORDION =================== --}}
    <div class="mt-14 border-t border-outline-variant/30">
        @foreach([
            ['Caractéristiques', $product->caracteristiques ?? 'Détails sur la confection et les matériaux.'],
            ['Entretien',       'Nettoyez avec un chiffon légèrement humide. Évitez l\'exposition prolongée au soleil. Rangez dans la pochette de protection fournie.'],
            ['Livraison',       'Livraison à Abidjan sous 24-48h. Livraison en Côte d\'Ivoire sous 3-5 jours. Emballage cadeau disponible sur demande.'],
        ] as [$label, $content])
        <details class="border-b border-outline-variant/30 group">
            <summary class="flex items-center justify-between py-5 cursor-pointer list-none">
                <span class="text-caption uppercase tracking-widest font-sans font-semibold text-primary">{{ $label }}</span>
                <span class="material-symbols-outlined text-on-surface-variant transition-transform group-open:rotate-180">expand_more</span>
            </summary>
            <p class="font-sans text-body text-on-surface-variant leading-relaxed pb-5">{{ $content }}</p>
        </details>
        @endforeach
    </div>

    {{-- =================== RELATED PRODUCTS =================== --}}
    @if(isset($relatedProducts) && $relatedProducts->isNotEmpty())
    <div class="mt-section">
        <div class="flex justify-between items-end mb-10 border-b border-outline-variant/30 pb-5">
            <h2 class="font-serif text-h2 text-primary">Vous aimerez aussi</h2>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-gutter">
            @foreach($relatedProducts as $rel)
            <div class="product-card group">
                <a href="{{ route('boutique.show', $rel->slug ?? $rel->id) }}"
                   class="block relative aspect-[3/4] overflow-hidden bg-surface-container-low mb-3">
                    @if($rel->image)
                    <img src="{{ asset('img/'.$rel->image) }}" alt="{{ $rel->nom }}"
                         class="card-img w-full h-full object-cover">
                    @else
                    <div class="card-img w-full h-full bg-surface-dim"></div>
                    @endif
                </a>
                <h3 class="font-serif text-h3 text-primary group-hover:text-secondary transition-colors">{{ $rel->nom }}</h3>
                <p class="font-sans text-body text-primary font-semibold">{{ number_format($rel->prix, 0, ',', ' ') }} FCFA</p>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>

@push('scripts')
<script>
    function changeMainImage(src) {
        const img = document.getElementById('main-image');
        if (img) {
            img.style.opacity = '0';
            setTimeout(() => {
                img.src = src;
                img.style.opacity = '1';
            }, 200);
        }
    }

    function selectColor(btn) {
        // Update border of selected color
        document.querySelectorAll('.color-swatch').forEach(b => b.classList.remove('border-secondary'));
        btn.classList.add('border-secondary');

        // Update hidden input value
        const colorId = btn.getAttribute('data-id');
        const colorInput = document.getElementById('selected-color-id');
        if (colorInput) {
            colorInput.value = colorId;
        }

        // Update image if color has one
        const imageSrc = btn.getAttribute('data-image');
        if (imageSrc) {
            changeMainImage(imageSrc);
        }
    }
</script>
@endpush

@endsection
