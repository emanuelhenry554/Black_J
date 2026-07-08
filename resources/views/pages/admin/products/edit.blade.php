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
                <input type="text" name="nom" value="{{ $product->nom }}" required class="px-4 py-3 bg-surface border border-outline-variant focus:border-secondary outline-none">
            </div>
            <div class="flex flex-col gap-2">
                <label class="text-caption uppercase tracking-widest text-on-surface-variant font-semibold">Slug *</label>
                <input type="text" name="slug" value="{{ $product->slug }}" required class="px-4 py-3 bg-surface border border-outline-variant focus:border-secondary outline-none">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="flex flex-col gap-2">
                <label class="text-caption uppercase tracking-widest text-on-surface-variant font-semibold">Catégorie *</label>
                <select name="categorie_id" class="px-4 py-3 bg-surface border border-outline-variant focus:border-secondary outline-none">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $product->categorie_id == $category->id ? 'selected' : '' }}>{{ $category->nom }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex flex-col gap-2">
                <label class="text-caption uppercase tracking-widest text-on-surface-variant font-semibold">Prix (FCFA) *</label>
                <input type="number" name="prix" value="{{ $product->prix }}" required class="px-4 py-3 bg-surface border border-outline-variant focus:border-secondary outline-none">
            </div>
            <div class="flex flex-col gap-2">
                <label class="text-caption uppercase tracking-widest text-on-surface-variant font-semibold">Stock initial *</label>
                <input type="number" name="stock" value="{{ $product->stock }}" required class="px-4 py-3 bg-surface border border-outline-variant focus:border-secondary outline-none">
            </div>
        </div>

        <div class="flex flex-col gap-2">
            <label class="text-caption uppercase tracking-widest text-on-surface-variant font-semibold">Description courte</label>
            <input type="text" name="description_courte" value="{{ $product->description_courte }}" class="px-4 py-3 bg-surface border border-outline-variant focus:border-secondary outline-none">
        </div>

        <div class="flex flex-col gap-2">
            <label class="text-caption uppercase tracking-widest text-on-surface-variant font-semibold">Description complète</label>
            <textarea name="description" rows="4" class="px-4 py-3 bg-surface border border-outline-variant focus:border-secondary outline-none">{{ $product->description }}</textarea>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="flex flex-col gap-2">
                <label class="text-caption uppercase tracking-widest text-on-surface-variant font-semibold">Matière</label>
                <input type="text" name="matiere" value="{{ $product->matiere }}" class="px-4 py-3 bg-surface border border-outline-variant focus:border-secondary outline-none">
            </div>
            <div class="flex flex-col gap-2">
                <label class="text-caption uppercase tracking-widest text-on-surface-variant font-semibold">Image principale (URL)</label>
                <div class="flex items-center gap-3">
                    <input type="text" name="image" value="{{ $product->image }}" class="flex-grow px-4 py-3 bg-surface border border-outline-variant focus:border-secondary outline-none">
                    <div class="w-12 h-12 rounded overflow-hidden border border-outline-variant">
                        <img src="{{ $product->image_url }}" alt="Preview" class="w-full h-full object-cover">
                    </div>
                </div>
            </div>
        </div>

        <div class="flex flex-col gap-4 p-4 bg-surface rounded-lg border border-outline-variant/30">
            <span class="text-caption uppercase tracking-widest text-primary font-bold">Images produits existantes</span>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                @foreach($product->images as $image)
                    <div class="w-full h-32 overflow-hidden rounded border border-outline-variant">
                        <img src="{{ $image->image_url }}" alt="{{ $product->nom }}" class="w-full h-full object-cover">
                    </div>
                @endforeach
            </div>
            <div class="flex flex-col gap-2">
                <label class="text-caption uppercase tracking-widest text-on-surface-variant font-semibold">Ajouter de nouvelles images</label>
                <input type="file" name="images[]" multiple accept="image/*" class="px-4 py-2 bg-surface border border-outline-variant focus:border-secondary outline-none text-sm">
            </div>
        </div>

        <div class="flex flex-col gap-4 p-4 bg-surface rounded-lg border border-outline-variant/30">
            <span class="text-caption uppercase tracking-widest text-primary font-bold">Couleurs disponibles</span>
            <div id="color-rows" class="flex flex-col gap-3">
                @foreach($product->colors as $index => $color)
                    <div class="color-row grid grid-cols-1 gap-3 md:grid-cols-[1fr_120px_80px] md:items-center">
                        <div class="grid grid-cols-1 gap-3 md:grid-cols-[1fr_120px]">
                            <input type="hidden" name="colors[{{ $index }}][id]" value="{{ $color->id }}">
                            <input type="hidden" name="colors[{{ $index }}][existing_image_path]" value="{{ $color->image_path }}">
                            <input type="text" name="colors[{{ $index }}][name]" value="{{ $color->name }}" placeholder="Nom de la couleur" class="px-3 py-2 bg-surface border border-outline-variant text-sm outline-none">
                            <input type="color" name="colors[{{ $index }}][hex]" value="{{ $color->hex }}" class="w-full h-10 p-0 border-none cursor-pointer bg-transparent">
                        </div>
                        <div class="grid grid-cols-1 gap-3 md:grid-cols-[1fr_80px]">
                            <input type="number" name="colors[{{ $index }}][stock]" value="{{ $color->stock ?? 0 }}" min="0" placeholder="Stock" class="px-3 py-2 bg-surface border border-outline-variant text-sm outline-none">
                            <input type="file" name="colors[{{ $index }}][image]" accept="image/*" class="w-full text-sm text-on-surface-variant">
                        </div>
                        <div class="flex items-center gap-3">
                            @if($color->image_url)
                                <div class="w-16 h-16 overflow-hidden rounded border border-outline-variant">
                                    <img src="{{ $color->image_url }}" alt="{{ $color->name }}" class="w-full h-full object-cover">
                                </div>
                            @endif
                            <button type="button" onclick="this.closest('.color-row').remove()" class="text-error self-start"><span class="material-symbols-outlined">delete</span></button>
                        </div>
                    </div>
                @endforeach
            </div>
            <button type="button" onclick="addColorRow()" class="text-xs font-bold text-secondary hover:underline w-fit">+ Ajouter une couleur</button>
        </div>

        <div class="flex flex-col gap-4 p-4 bg-surface rounded-lg border border-outline-variant/30">
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
@push('scripts')
<script>
    let colorCount = {{ $product->colors->count() }};
    function addColorRow() {
        const container = document.getElementById('color-rows');
        const div = document.createElement('div');
        div.className = 'color-row grid grid-cols-1 gap-3 md:grid-cols-[1fr_120px_80px] md:items-center';
        div.innerHTML = `
            <div class="grid grid-cols-1 gap-3 md:grid-cols-[1fr_120px]">
                <input type="hidden" name="colors[${colorCount}][existing_image_path]" value="">
                <input type="text" name="colors[${colorCount}][name]" placeholder="Nom de la couleur" class="px-3 py-2 bg-surface border border-outline-variant text-sm outline-none">
                <input type="color" name="colors[${colorCount}][hex]" class="w-full h-10 p-0 border-none cursor-pointer bg-transparent">
            </div>
            <div class="grid grid-cols-1 gap-3 md:grid-cols-[1fr_80px]">
                <input type="number" name="colors[${colorCount}][stock]" min="0" placeholder="Stock" class="px-3 py-2 bg-surface border border-outline-variant text-sm outline-none">
                <input type="file" name="colors[${colorCount}][image]" accept="image/*" class="w-full text-sm text-on-surface-variant">
            </div>
            <div class="flex items-center gap-3">
                <button type="button" onclick="this.closest('.color-row').remove()" class="text-error self-start"><span class="material-symbols-outlined">delete</span></button>
            </div>
        `;
        container.appendChild(div);
        colorCount++;
    }
</script>
@endpush

@endsection
