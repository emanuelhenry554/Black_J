@extends('layouts.app')

@section('title', 'Innovation — Blac Joyaux')
@section('meta_description', 'Découvrez l\'approche innovante de Blac Joyaux, où le luxe traditionnel rencontre la modernité.')

@section('content')
<div class="bg-surface border-b border-outline-variant/30 py-10">
    <div class="max-w-site mx-auto px-px-mobile md:px-px-desktop text-center">
        <h1 class="font-serif text-h1 text-primary">Innovation — Exemples de Sacs</h1>
        <div class="w-8 h-px bg-secondary mx-auto mt-4"></div>
    </div>
</div>

<div class="max-w-site mx-auto px-px-mobile md:px-px-desktop py-12 md:py-20">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @foreach($innovationItems as $it)
        <a href="{{ route('innovation.show', $it['id']) }}" class="innovation-card group bg-surface border border-outline-variant/30 p-3 rounded shadow-card text-left">
            <div class="aspect-[4/5] overflow-hidden rounded mb-3">
                <img src="{{ $it['img'] }}" alt="{{ $it['title'] }}" class="w-full h-full object-cover">
            </div>
            <div>
                <h3 class="font-serif text-h4 text-primary">{{ $it['title'] }}</h3>
                <p class="text-sm text-on-surface-variant">{{ number_format($it['price'], 0, ',', ' ') }} FCFA</p>
            </div>
        </a>
        @endforeach
    </div>
</div>
@endsection
