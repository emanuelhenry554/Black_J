@extends('layouts.admin')

@section('page_title', 'Catalogue Produits')

@section('content')
<div class="flex flex-col gap-6">

    @if(session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-3 rounded-lg">{{ session('success') }}</div>
    @endif

    <div class="flex items-center justify-between">
        <h2 class="font-serif text-h2 text-primary">Liste des produits</h2>
        <a href="{{ route('admin.products.create') }}" class="btn-primary py-2 px-4 flex items-center gap-2">
            <span class="material-symbols-outlined text-[20px]">add</span> Nouveau produit
        </a>
    </div>

    <div class="bg-surface border border-outline-variant/30 rounded-lg overflow-hidden shadow-card">
        <table class="w-full text-left border-collapse">
            <thead class="bg-surface text-caption uppercase tracking-widest text-on-surface-variant font-semibold">
                <tr>
                    <th class="px-6 py-3">Produit</th>
                    <th class="px-6 py-3">Catégorie</th>
                    <th class="px-6 py-3">Prix</th>
                    <th class="px-6 py-3">Stock</th>
                    <th class="px-6 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-outline-variant/30">
                @forelse($products as $product)
                <tr class="hover:bg-surface/50 transition-colors">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-surface rounded overflow-hidden">
                                @if($product->image)
                                    <img src="{{ $product->image_url }}"
                                         alt="{{ $product->nom }}"
                                         class="w-full h-full object-cover">
                                @else
                                    <span class="material-symbols-outlined w-full h-full flex items-center justify-center text-outline-variant">shopping_bag</span>
                                @endif
                            </div>
                            <span class="font-semibold text-primary">{{ $product->nom }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-on-surface-variant">
                        {{ $product->category->nom ?? '—' }}
                    </td>
                    <td class="px-6 py-4 text-primary font-semibold">
                        {{ number_format($product->prix, 0, ',', ' ') }} FCFA
                    </td>
                    <td class="px-6 py-4 text-on-surface-variant">
                        {{ $product->stock ?? 0 }} pcs
                    </td>
                    <td class="px-6 py-4 text-right flex justify-end gap-2">
                        <a href="{{ route('admin.products.edit', $product->id) }}"
                           class="p-2 text-on-surface-variant hover:text-secondary transition-colors"
                           title="Modifier">
                            <span class="material-symbols-outlined text-[20px]">edit</span>
                        </a>
                        <form action="{{ route('admin.products.destroy', $product->id) }}"
                              method="POST"
                              onsubmit="return confirm('Supprimer ce produit ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="p-2 text-on-surface-variant hover:text-error transition-colors"
                                    title="Supprimer">
                                <span class="material-symbols-outlined text-[20px]">delete</span>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-on-surface-variant">
                        Aucun produit trouvé.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
