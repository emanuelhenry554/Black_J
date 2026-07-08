@extends('layouts.app')

@section('title', $item['title'] . ' — Innovation Blac Joyaux')
@section('meta_description', $item['desc'])

@section('content')
<div class="bg-surface border-b border-outline-variant/30 py-10">
    <div class="max-w-site mx-auto px-px-mobile md:px-px-desktop text-center">
        <h1 class="font-serif text-h1 text-primary">Détail de l'Innovation</h1>
        <div class="w-8 h-px bg-secondary mx-auto mt-4"></div>
    </div>
</div>

<div class="max-w-site mx-auto px-px-mobile md:px-px-desktop py-16 md:py-24">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
        <div class="relative">
            <div class="relative w-full overflow-hidden shadow-luxury rounded-lg">
                <img src="{{ $item['img'] }}" alt="{{ $item['title'] }}" class="w-full h-auto block">
            </div>
            <div class="absolute -bottom-6 -right-6 w-48 h-48 border-4 border-secondary -z-10 hidden md:block"></div>
        </div>
        <div class="flex flex-col gap-6">
            <div class="flex flex-col gap-2">
                <span class="chip-gold w-fit">Innovation Signature</span>
                <h2 class="font-serif text-h2 text-primary leading-tight">{{ $item['title'] }}</h2>
            </div>

            <p class="font-sans text-body text-on-surface-variant leading-relaxed text-lg italic">
                "{{ $item['desc'] }}"
            </p>

            <p class="font-sans text-body text-on-surface-variant leading-relaxed">
                {{ $item['full_desc'] }}
            </p>

            <div class="flex gap-8 pt-4">
                <div class="flex flex-col">
                    <span class="text-h3 font-serif text-secondary">Matière</span>
                    <span class="text-caption uppercase tracking-widest text-on-surface-variant font-semibold">Cuir Pleine Fleur</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-h3 font-serif text-secondary">Prix</span>
                    <span class="text-caption uppercase tracking-widest text-on-surface-variant font-semibold">{{ number_format($item['price'], 0, ',', ' ') }} FCFA</span>
                </div>
            </div>

            <div class="pt-6">
                <form action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $item['id'] }}">
                    <input type="hidden" name="quantity" value="1">
                    <button type="submit" class="btn-primary w-full md:w-auto">Commander ce modèle</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
