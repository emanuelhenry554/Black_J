@extends('layouts.admin')

@section('page_title', 'Gestion Inventaire')

@section('content')
<div class="flex flex-col gap-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="font-serif text-h2 text-primary">État des stocks</h2>
    </div>

    <div class="bg-surface border border-outline-variant/30 rounded-lg overflow-hidden shadow-card">
        <table class="w-full text-left border-collapse">
            <thead class="bg-surface text-caption uppercase tracking-widest text-on-surface-variant font-semibold">
                <tr class="border-b border-outline-variant/30">
                    <th class="px-6 py-3">Produit</th>
                    <th class="px-6 py-3">Quantité actuelle</th>
                    <th class="px-6 py-3">Statut</th>
                    <th class="px-6 py-3 text-right">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-outline-variant/30">
                @forelse($products as $product)
                <tr class="hover:bg-surface/50 transition-colors">
                    <td class="px-6 py-4 font-semibold text-primary">{{ $product->nom }}</td>
                    <td class="px-6 py-4 text-on-surface-variant font-bold">{{ $product->stock }} pcs</td>
                    <td class="px-6 py-4">
                        @if($product->stock > 5)
                            <span class="px-2 py-1 text-[10px] font-bold uppercase rounded bg-green-100 text-green-700 border border-green-200">En stock</span>
                        @elseif($product->stock > 0)
                            <span class="px-2 py-1 text-[10px] font-bold uppercase rounded bg-yellow-100 text-yellow-700 border border-yellow-200">Stock faible</span>
                        @else
                            <span class="px-2 py-1 text-[10px] font-bold uppercase rounded bg-red-100 text-red-700 border border-red-200">Rupture</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right">
                        <button onclick="openUpdateModal({{ $product->id }}, '{{ $product->nom }}', {{ $product->stock }})"
                                class="text-secondary hover:underline text-sm font-semibold">Mettre à jour</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-10 text-center text-on-surface-variant">Aucun produit en inventaire.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Update Modal --}}
<div id="update-modal" class="fixed inset-0 bg-black/50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-surface w-full max-w-md rounded-lg shadow-luxury overflow-hidden">
        <div class="p-6 border-b border-outline-variant/30 flex justify-between items-center">
            <h3 class="font-serif text-h3 text-primary">Mise à jour du stock</h3>
            <button onclick="closeUpdateModal()" class="text-on-surface-variant hover:text-primary"><span class="material-symbols-outlined">close</span></button>
        </div>
        <form id="update-stock-form" method="POST" class="p-6 flex flex-col gap-6">
            @csrf
            <input type="hidden" name="_method" value="PATCH">
            <div class="flex flex-col gap-2">
                <label class="text-caption uppercase tracking-widest text-on-surface-variant font-semibold">Produit</label>
                <p id="modal-product-name" class="text-body text-primary font-bold"></p>
            </div>
            <div class="flex flex-col gap-2">
                <label class="text-caption uppercase tracking-widest text-on-surface-variant font-semibold">Nouvelle quantité</label>
                <input type="number" name="stock" id="modal-stock" required min="0"
                       class="px-4 py-3 bg-surface border border-outline-variant focus:border-secondary outline-none">
            </div>
            <div class="flex justify-end gap-3 pt-4">
                <button type="button" onclick="closeUpdateModal()" class="px-6 py-2 text-sm font-semibold text-on-surface-variant hover:text-primary">Annuler</button>
                <button type="submit" class="btn-primary py-2 px-6">Mettre à jour</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function openUpdateModal(id, name, stock) {
        const modal = document.getElementById('update-modal');
        const form = document.getElementById('update-stock-form');
        const nameEl = document.getElementById('modal-product-name');
        const stockEl = document.getElementById('modal-stock');

        form.action = `/admin/inventaire/${id}`;
        nameEl.innerText = name;
        stockEl.value = stock;
        modal.classList.remove('hidden');
    }

    function closeUpdateModal() {
        document.getElementById('update-modal').classList.add('hidden');
    }

    document.getElementById('update-modal').addEventListener('click', (e) => {
        if (e.target === document.getElementById('update-modal')) closeUpdateModal();
    });
</script>
@endpush

@endsection
