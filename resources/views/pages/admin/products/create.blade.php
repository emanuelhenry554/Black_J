@extends('layouts.admin')

@section('page_title', 'Ajouter un Produit')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-8 flex items-center gap-4">
        <a href="{{ route('admin.products.index') }}" class="p-2 bg-surface border border-outline-variant/30 rounded-full hover:text-secondary transition-colors">
            <span class="material-symbols-outlined">arrow_back</span>
        </a>
        <h2 class="font-serif text-h2 text-primary">Créer un nouveau produit</h2>
    </div>

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="bg-surface border border-outline-variant/30 p-8 rounded-lg shadow-luxury flex flex-col gap-8">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="flex flex-col gap-2">
                <label class="text-caption uppercase tracking-widest text-on-surface-variant font-semibold">Nom du produit *</label>
                <input type="text" name="nom" required class="px-4 py-3 bg-surface border border-outline-variant focus:border-secondary outline-none">
            </div>
            <div class="flex flex-col gap-2">
                <label class="text-caption uppercase tracking-widest text-on-surface-variant font-semibold">Slug *</label>
                <input type="text" name="slug" required class="px-4 py-3 bg-surface border border-outline-variant focus:border-secondary outline-none">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="flex flex-col gap-2">
                <label class="text-caption uppercase tracking-widest text-on-surface-variant font-semibold">Catégorie *</label>
                <select name="categorie_id" required class="px-4 py-3 bg-surface border border-outline-variant focus:border-secondary outline-none">
                    <option value="">Sélectionnez...</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->nom }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex flex-col gap-2">
                <label class="text-caption uppercase tracking-widest text-on-surface-variant font-semibold">Prix (FCFA) *</label>
                <input type="number" name="prix" required class="px-4 py-3 bg-surface border border-outline-variant focus:border-secondary outline-none">
            </div>
            <div class="flex flex-col gap-2">
                <label class="text-caption uppercase tracking-widest text-on-surface-variant font-semibold">Stock initial *</label>
                <input type="number" name="stock" required class="px-4 py-3 bg-surface border border-outline-variant focus:border-secondary outline-none">
            </div>
        </div>

        <div class="flex flex-col gap-2">
            <label class="text-caption uppercase tracking-widest text-on-surface-variant font-semibold">Description courte</label>
            <input type="text" name="description_courte" class="px-4 py-3 bg-surface border border-outline-variant focus:border-secondary outline-none">
        </div>

        <div class="flex flex-col gap-2">
            <label class="text-caption uppercase tracking-widest text-on-surface-variant font-semibold">Description complète</label>
            <textarea name="description" rows="4" class="px-4 py-3 bg-surface border border-outline-variant focus:border-secondary outline-none"></textarea>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="flex flex-col gap-2">
                <label class="text-caption uppercase tracking-widest text-on-surface-variant font-semibold">Matière</label>
                <input type="text" name="matiere" class="px-4 py-3 bg-surface border border-outline-variant focus:border-secondary outline-none">
            </div>
            <div class="flex flex-col gap-2">
                <label class="text-caption uppercase tracking-widest text-on-surface-variant font-semibold">Images du produit (Plusieurs possibles)</label>
                <input type="file" name="images[]" multiple accept="image/*" class="px-4 py-2 bg-surface border border-outline-variant focus:border-secondary outline-none text-sm">
            </div>
        </div>

        {{-- Colors Section --}}
        <div class="flex flex-col gap-4 p-4 bg-surface rounded-lg border border-outline-variant/30">
            <div class="flex justify-between items-center">
                <span class="text-caption uppercase tracking-widest text-primary font-bold">Couleurs disponibles</span>
                <button type="button" onclick="addColorRow()" class="text-xs font-bold text-secondary hover:underline">+ Ajouter une couleur</button>
            </div>
            <div id="color-rows" class="flex flex-col gap-3">
                <div class="color-row grid grid-cols-1 gap-3 md:grid-cols-[1fr_auto] md:items-center">
                    <div class="grid grid-cols-1 gap-3 md:grid-cols-[1fr_120px_80px]">
                        <input type="text" name="colors[0][name]" placeholder="Ex: Noir Profond" class="px-3 py-2 bg-surface border border-outline-variant text-sm outline-none">
                        <input type="color" name="colors[0][hex]" class="w-full h-10 p-0 border-none cursor-pointer bg-transparent">
                        <input type="file" name="colors[0][image]" accept="image/*" class="w-full text-sm text-on-surface-variant">
                    </div>
                    <button type="button" onclick="this.closest('.color-row').remove()" class="text-error self-start"><span class="material-symbols-outlined">delete</span></button>
                </div>
            </div>
        </div>

        <div class="flex flex-wrap items-center gap-6">
            <label class="flex items-center gap-2 cursor-pointer group">
                <input type="checkbox" name="edition_limitee" class="w-4 h-4 accent-secondary">
                <span class="text-sm text-on-surface-variant group-hover:text-primary transition-colors">Édition Limitée</span>
            </label>
            <label class="flex items-center gap-2 cursor-pointer group">
                <input type="checkbox" name="nouveau" class="w-4 h-4 accent-secondary">
                <span class="text-sm text-on-surface-variant group-hover:text-primary transition-colors">Nouveau produit</span>
            </label>
            <label class="flex items-center gap-2 cursor-pointer group">
                <input type="checkbox" name="is_featured" class="w-4 h-4 accent-secondary">
                <span class="text-sm text-on-surface-variant group-hover:text-primary transition-colors">Modèle Phare (Accueil)</span>
            </label>
            <label class="flex items-center gap-2 cursor-pointer group">
                <input type="checkbox" name="is_new" class="w-4 h-4 accent-secondary">
                <span class="text-sm text-on-surface-variant group-hover:text-primary transition-colors">Section Nouveautés</span>
            </label>
        </div>

        <div class="pt-6 border-t border-outline-variant/30 flex justify-end gap-3">
            <a href="{{ route('admin.products.index') }}" class="px-6 py-3 text-sm font-semibold text-on-surface-variant hover:text-primary transition-colors">Annuler</a>
            <button type="submit" class="btn-primary px-8 py-3">Enregistrer le produit</button>
        </div>
    </form>
</div>

@push('scripts')
<script>
    let colorCount = 1;
    function addColorRow() {
        const container = document.getElementById('color-rows');
        const div = document.createElement('div');
        div.className = 'color-row grid grid-cols-1 gap-3 md:grid-cols-[1fr_120px_200px_80px] md:items-center';
        div.innerHTML = `
            <input type="text" name="colors[${colorCount}][name]" placeholder="Ex: Rouge Passion" class="px-3 py-2 bg-surface border border-outline-variant text-sm outline-none">
            <input type="color" name="colors[${colorCount}][hex]" class="w-full h-10 p-0 border-none cursor-pointer bg-transparent">
            <input type="file" name="colors[${colorCount}][image]" accept="image/*" class="w-full text-sm text-on-surface-variant">
            <button type="button" onclick="this.closest('.color-row').remove()" class="text-error self-start"><span class="material-symbols-outlined">delete</span></button>
        `;
        container.appendChild(div);
        colorCount++;
    }
</script>
@endpush

@endsection
