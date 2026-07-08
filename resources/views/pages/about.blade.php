@extends('layouts.app')

@section('title', 'À Propos — Blac Joyaux')
@section('meta_description', 'Découvrez l\'histoire de Blac Joyaux, maison de maroquinerie de luxe basée à Abidjan.')

@section('content')
<div class="bg-surface border-b border-outline-variant/30 py-10">
    <div class="max-w-site mx-auto px-px-mobile md:px-px-desktop text-center">
        <p class="text-caption uppercase tracking-widest text-secondary font-sans font-semibold mb-3">L\'Héritage</p>
        <h1 class="font-serif text-h1 text-primary">Notre Histoire</h1>
        <div class="w-8 h-px bg-secondary mx-auto mt-4"></div>
    </div>
</div>

<div class="max-w-site mx-auto px-px-mobile md:px-px-desktop py-16 md:py-24">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
        <div class="relative">
            <div class="aspect-[3/4] bg-surface overflow-hidden shadow-luxury">
                <img src="{{ asset('img/sacs-blac-joyaux.jpeg') }}" alt="Atelier Blac Joyaux" class="w-full h-full object-cover">
            </div>
            <div class="absolute -bottom-6 -right-6 w-48 h-48 border-4 border-secondary -z-10 hidden md:block"></div>
        </div>
        <div class="flex flex-col gap-6">
            <h2 class="font-serif text-h2 text-primary leading-tight">L'excellence artisanale, née au cœur d'Abidjan.</h2>
            <p class="font-sans text-body text-on-surface-variant leading-relaxed">
                Blac Joyaux n'est pas simplement une marque de maroquinerie. C'est une célébration du savoir-faire ivoirien et de l'élégance intemporelle. Chaque pièce est imaginée et confectionnée avec une attention obsessionnelle aux détails, alliant cuir de première qualité et design contemporain.
            </p>
            <p class="font-sans text-body text-on-surface-variant leading-relaxed">
                Notre mission est d'offrir des accessoires qui ne se contentent pas d'accompagner vos journées, mais qui racontent une histoire de prestige et de raffinement. De l'esquisse initiale à la dernière couture, nous privilégions la qualité sur la quantité.
            </p>
            <div class="flex gap-8 pt-4">
                <div class="flex flex-col">
                    <span class="text-h3 font-serif text-secondary">100%</span>
                    <span class="text-caption uppercase tracking-widest text-on-surface-variant font-semibold">Artisanat Main</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-h3 font-serif text-secondary">Premium</span>
                    <span class="text-caption uppercase tracking-widest text-on-surface-variant font-semibold">Cuirs Sélectionnés</span>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- SECTION DETAIL ARTISANAL --}}
<div class="max-w-site mx-auto px-px-mobile md:px-px-desktop py-16 md:py-24">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
        <div class="flex flex-col gap-6 order-2 md:order-1">
            <h2 class="font-serif text-h2 text-primary leading-tight">Le Détail qui fait la Différence.</h2>
            <p class="font-sans text-body text-on-surface-variant leading-relaxed">
                Chaque point de couture, chaque boucle et chaque finition est pensé pour durer. Nous croyons que le véritable luxe réside dans l'invisible : la structure interne, la qualité du fil et la précision du montage.
            </p>
            <div class="w-8 h-px bg-secondary"></div>
        </div>
        <div class="relative order-1 md:order-2">
            <div class="aspect-square bg-surface overflow-hidden shadow-luxury border border-outline-variant/30">
                <img src="{{ asset('img/sacs-blac-joyaux-2.jpeg') }}" alt="Détail Artisanat Blac Joyaux" class="w-full h-full object-cover">
            </div>
            <div class="absolute -top-6 -left-6 w-32 h-32 border-4 border-secondary -z-10 hidden md:block"></div>
        </div>
    </div>
</div>
@endsection
