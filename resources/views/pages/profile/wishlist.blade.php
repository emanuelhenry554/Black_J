@extends('pages.profile')

@section('profile_content')
<div class="flex flex-col gap-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="font-serif text-h2 text-primary">Mes Favoris</h2>
        <span class="text-caption text-on-surface-variant uppercase tracking-widest font-semibold">Articles sauvegardés</span>
    </div>

    @if(false) {{-- Simulating empty state --}}
        <div class="text-center py-20 bg-surface-container-low border border-dashed border-outline-variant/50 rounded-lg">
            <span class="material-symbols-outlined text-6xl text-outline-variant mb-4">favorite</span>
            <p class="font-sans text-body text-on-surface-variant mb-6">Votre liste de souhaits est encore vide.</p>
            <a href="{{ route('boutique.index') }}" class="btn-primary">Explorer la boutique</a>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            {{-- Wishlist Item 1 --}}
            <div class="bg-surface border border-outline-variant/30 p-4 rounded-lg shadow-card flex gap-4 group">
                <div class="w-20 h-24 bg-surface-container rounded overflow-hidden flex-shrink-0">
                    <span class="material-symbols-outlined w-full h-full flex items-center justify-center text-outline-variant">shopping_bag</span>
                </div>
                <div class="flex flex-col justify-between flex-grow">
                    <div>
                        <h3 class="font-serif text-h3 text-primary group-hover:text-secondary transition-colors">Sac Luxe Or</h3>
                        <p class="text-sm text-on-surface-variant">Luxe</p>
                    </div>
                    <div class="flex items-center justify-between mt-2">
                        <span class="font-sans font-bold text-primary">250 000 FCFA</span>
                        <a href="{{ route('boutique.index') }}" class="text-caption uppercase tracking-widest text-secondary font-bold hover:underline">Détails</a>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
