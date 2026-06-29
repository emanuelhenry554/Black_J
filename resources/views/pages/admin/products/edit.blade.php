@extends('layouts.admin')

@section('page_title', 'Modifier le Produit')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-8 flex items-center gap-4">
        <a href="{{ route('admin.products.index') }}" class="p-2 bg-surface border border-outline-variant/30 rounded-full hover:text-secondary transition-colors">
            <span class="material-symbols-outlined">arrow_back</span>
        </a>
        <h2 class="font-serif text-h2 text-primary">Modifier : {{ $product->nom }}</h2>
    </div>

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="bg-surface border border-outline-variant/30 p-8 rounded-lg shadow-luxury flex flex-col gap-8">
        @csrf @method('PATCH')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="flex flex-col gap-2">
                <label class="text-caption uppercase tracking-widest text-on-surface-variant font-semibold">Nom du produit *</label>
                <input type="text" name="nom" value="{{ $product->nom }}" required class="px-4 py-3 bg-surface-container border border-outline-variant focus:border-secondary outline-none">
            </div>
            <div class="flex flex-col gap-2">
                <label class="text-caption uppercase tracking-widest text-on-surface-variant font-semibold">Slug *</label>
                <input type="text" name="slug" value="{{ $product->slug }}" required class="px-4 py-3 bg-surface-container border border-outline-variant focus:border-secondary outline-none">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="flex flex-col gap-2">
                <label class="text-caption uppercase tracking-widest text-on-surface-variant font-semibold">Catégorie *</label>
                <select name="categorie_id" class="px-4 py-3 bg-surface-container border border-outline-variant focus:border-secondary outline-none">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $product->categorie_id == $category->id ? 'selected' : '' }}>{{ $category->nom }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex flex-col gap-2">
                <label class="text-caption uppercase tracking-widest text-on-surface-variant font-semibold">Prix (FCFA) *</label>
                <input type="number" name="prix" value="{{ $product->prix }}" required class="px-4 py-3 bg-surface-container border border-outline-variant focus:border-secondary outline-none">
            </div>
            <div class="flex flex-col gap-2">
                <label class="text-caption uppercase tracking-widest text-on-surface-variant font-semibold">Stock initial *</label>
                <input type="number" name="stock" value="{{ $product->stock }}" required class="px-4 py-3 bg-surface-container border border-outline-variant focus:border-secondary outline-none">
            </div>
        </div>

        <div class="flex flex-col gap-2">
            <label class="text-caption uppercase tracking-widest text-on-surface-variant font-semibold">Description courte</label>
            <input type="text" name="description_courte" value="{{ $product->description_courte }}" class="px-4 py-3 bg-surface-container border border-outline-variant focus:border-secondary outline-none">
        </div>

        <div class="flex flex-col gap-2">
            <label class="text-caption uppercase tracking-widest text-on-surface-variant font-semibold">Description complète</label>
            <textarea name="description" rows="4" class="px-4 py-3 bg-surface-container border border-outline-variant focus:border-secondary outline-none">{{ $product->description }}</textarea>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="flex flex-col gap-2">
                <label class="text-caption uppercase tracking-widest text-on-surface-variant font-semibold">Matière</label>
                <input type="text" name="matiere" value="{{ $product->matiere }}" class="px-4 py-3 bg-surface-container border border-outline-variant focus:border-secondary outline-none">
            </div>
            <div class="flex flex-col gap-2">
                <label class="text-caption uppercase tracking-widest text-on-surface-variant font-semibold">Image principale (URL)</label>
                <input type="text" name="image" value="{{ $product->image }}" class="px-4 py-3 bg-surface-container border border-outline-variant focus:border-secondary outline-none">
            </div>
        </div>

        <div class="flex flex-col gap-4 p-4 bg-surface-container rounded-lg border border-outline-variant/30">
            <span class="text-caption uppercase tracking-widest text-primary font-bold">Visibilité & Marquage</span>
            <div class="flex flex-wrap gap-6">
                <label class="flex items-center gap-2 cursor-pointer group">
                    <input type="checkbox" name="edition_limitee" {{ $product->edition_limitee ? 'checked' : '' }} class="w-4 h-4 accent-secondary">
                    <span class="text-sm text-on-surface-variant group-hover:text-primary transition-colors">Édition Limitée</span>
                </label>
                <label class="flex items-center gap-2 cursor-pointer group">
                    <input type="checkbox" name="nouveau" {{ $product->nouveau ? 'checked' : '' }} class="w-4 h-4 accent-secondary">
                    <span class="text-sm text-on-surface-variant group-hover:text-primary transition-colors">Nouveau produit</span>
                </label>
                <label class="flex items-center gap-2 cursor-pointer group">
                    <input type="checkbox" name="is_featured" {{ $product->is_featured ? 'checked' : '' }} class="w-4 h-4 accent-secondary">
                    <span class="text-sm text-on-surface-variant group-hover:text-primary transition-colors">Afficher en Modèle Phare</span>
                </label>
                <label class="flex items-center gap-2 cursor-pointer group">
                    <input type="checkbox" name="is_new" {{ $product->is_new ? 'checked' : '' }} class="w-4 h-4 accent-secondary">
                    <span class="text-sm text-on-surface-variant group-hover:text-primary transition-colors">Afficher en Nouveautés</span>
                </label>
            </div>
        </div>

        <div class="pt-6 border-t border-outline-variant/30 flex justify-end gap-3">
            <a href="{{ route('admin.products.index') }}" class="px-6 py-3 text-sm font-semibold text-on-surface-variant hover:text-primary transition-colors">Annuler</a>
            <button type="submit" class="btn-primary px-8 py-3">Enregistrer les modifications</button>
        </div>
    </form>
</div>
@endsection
