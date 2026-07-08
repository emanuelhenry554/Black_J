@extends('pages.profile')

@section('profile_content')
<div class="flex flex-col gap-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="font-serif text-h2 text-primary">Mes Favoris</h2>
        <span class="text-caption text-on-surface-variant uppercase tracking-widest font-semibold">Articles sauvegardés</span>
    </div>

    @if($products->isEmpty())
        <div class="text-center py-20 bg-surface border border-dashed border-outline-variant/50 rounded-lg">
            <span class="material-symbols-outlined text-6xl text-outline-variant mb-4">favorite</span>
            <p class="font-sans text-body text-on-surface-variant mb-6">Votre liste de souhaits est encore vide.</p>
            <a href="{{ route('boutique.index') }}" class="btn-primary">Explorer la boutique</a>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            @foreach($products as $product)
            <div class="bg-surface border border-outline-variant/30 p-4 rounded-lg shadow-card flex flex-col gap-4 group">
                <div class="flex items-start justify-between gap-4">
                    <div class="w-24 h-28 bg-surface rounded overflow-hidden flex-shrink-0">
                        @if($product->image)
                        <img src="{{ asset('img/'.$product->image) }}" alt="{{ $product->nom }}" class="w-full h-full object-cover">
                        @else
                        <div class="w-full h-full bg-surface"></div>
                        @endif
                    </div>
                    <form method="POST" action="{{ route('profile.wishlist.remove', $product) }}" class="self-start">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-error text-caption uppercase tracking-widest font-semibold hover:underline">Retirer</button>
                    </form>
                </div>
                <div class="flex flex-col gap-2">
                    <a href="{{ route('boutique.show', $product->slug ?? $product->id) }}" class="group">
                        <h3 class="font-serif text-h3 text-primary group-hover:text-secondary transition-colors">{{ $product->nom }}</h3>
                    </a>
                    <p class="text-caption uppercase tracking-widest text-on-surface-variant">{{ $product->categorie->nom ?? 'Produit' }}</p>
                    <p class="font-sans text-body text-primary font-semibold">{{ number_format($product->prix, 0, ',', ' ') }} FCFA</p>
                </div>
                <div class="flex items-center gap-3 mt-auto">
                    <a href="{{ route('boutique.show', $product->slug ?? $product->id) }}" class="btn-outline flex-1 text-center">Voir</a>
                    <form method="POST" action="{{ route('cart.add') }}" class="flex-1">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit" class="btn-primary w-full">Ajouter au panier</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
