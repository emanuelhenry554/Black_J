@extends('layouts.admin')

@section('page_title', 'Catalogue Produits')

@section('content')
<div class="flex flex-col gap-6">
    <div class="flex items-center justify-between">
        <h2 class="font-serif text-h2 text-primary">Liste des produits</h2>
        <a href="{{ route('admin.products.create') }}" class="btn-primary py-2 px-4 flex items-center gap-2">
            <span class="material-symbols-outlined text-[20px]">add</span> Nouveau produit
        </a>
    </div>

    <div class="bg-surface border border-outline-variant/30 rounded-lg overflow-hidden shadow-card">
        <table class="w-full text-left border-collapse">
            <thead class="bg-surface-container text-caption uppercase tracking-widest text-on-surface-variant font-semibold">
                <tr>
                    <th class="px-6 py-3">Produit</th>
                    <th class="px-6 py-3">Catégorie</th>
                    <th class="px-6 py-3">Prix</th>
                    <th class="px-6 py-3">Stock</th>
                    <th class="px-6 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-outline-variant/30">
                {{-- Simulation de données puisque le contrôleur est un squelette --}}
                <tr class="hover:bg-surface-container/50 transition-colors">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-surface-dim rounded overflow-hidden">
                                <span class="material-symbols-outlined w-full h-full flex items-center justify-center text-outline-variant">shopping_bag</span>
                            </div>
                            <span class="font-semibold text-primary">Sac Luxe Or</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-on-surface-variant">Luxe</td>
                    <td class="px-6 py-4 text-primary font-semibold">250 000 FCFA</td>
                    <td class="px-6 py-4 text-on-surface-variant">12 pcs</td>
                    <td class="px-6 py-4 text-right flex justify-end gap-2">
                        <a href="{{ route('admin.products.edit', 1) }}" class="p-2 text-on-surface-variant hover:text-secondary transition-colors" title="Modifier">
                            <span class="material-symbols-outlined text-[20px]">edit</span>
                        </a>
                        <button class="p-2 text-on-surface-variant hover:text-error transition-colors" title="Supprimer">
                            <span class="material-symbols-outlined text-[20px]">delete</span>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
