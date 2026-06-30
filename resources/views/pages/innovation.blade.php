@extends('layouts.app')

@section('title', 'Innovation — Blac Joyaux')
@section('meta_description', 'Découvrez l\'approche innovante de Blac Joyaux, où le luxe traditionnel rencontre la modernité.')

@section('content')
<div class="bg-surface-container-low border-b border-outline-variant/30 py-10 pattern-bg">
    <div class="max-w-site mx-auto px-px-mobile md:px-px-desktop text-center">
        <p class="text-caption uppercase tracking-widest text-secondary font-sans font-semibold mb-3">Avant-Garde</p>
        <h1 class="font-serif text-h1 text-primary">L'Innovation au service du Luxe</h1>
        <div class="w-8 h-px bg-secondary mx-auto mt-4"></div>
    </div>
</div>

<div class="max-w-site mx-auto px-px-mobile md:px-px-desktop py-16 md:py-24">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
        <div class="relative">
            <div class="aspect-[3/4] bg-surface-container overflow-hidden shadow-luxury">
                <img src="https://images.unsplash.com/photo-1581539702727-5e853f2210de?q=80&w=1000&auto=format&fit=crop" alt="Innovation Blac Joyaux" class="w-full h-full object-cover">
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

{{-- =================== GALLERY SECTION =================== --}}
<div class="max-w-site mx-auto px-px-mobile md:px-px-desktop py-16 border-t border-outline-variant/20">
    <div class="text-center mb-12">
        <h2 class="font-serif text-h2 text-primary mb-3">L'Atelier de Création</h2>
        <p class="font-sans text-body text-on-surface-variant max-w-xl mx-auto">
            Un aperçu de nos processus de recherche et de nos explorations de matières.
        </p>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
        @php
        $gallery = [
            [
                'img' => 'https://images.unsplash.com/photo-1594633312685-755ed667838d?q=80&w=1000&auto=format&fit=crop',
                'title' => 'Recherche Matières',
                'desc' => 'Exploration de cuirs végétaux et durables.'
            ],
            [
                'img' => 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?q=80&w=1000&auto=format&fit=crop',
                'title' => 'Précision Technique',
                'desc' => 'L\'art du montage et de la structure.'
            ],
            [
                'img' => 'https://images.unsplash.com/photo-1531938767921-9ed5f0ed27a2?q=80&w=1000&auto=format&fit=crop',
                'title' => 'Design Contemporain',
                'desc' => 'Épure et minimalisme architectural.'
            ],
        ];
        @endphp
        @foreach($gallery as $item)
        <div class="group cursor-pointer">
            <div class="relative aspect-square overflow-hidden bg-surface-container shadow-card mb-4">
                <img src="{{ $item['img'] }}" alt="{{ $item['title'] }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                <div class="absolute inset-0 bg-primary/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            </div>
            <h3 class="font-serif text-h3 text-primary mb-1">{{ $item['title'] }}</h3>
            <p class="font-sans text-sm text-on-surface-variant leading-relaxed">{{ $item['desc'] }}</p>
        </div>
        @endforeach
    </div>
</div>
@endsection
