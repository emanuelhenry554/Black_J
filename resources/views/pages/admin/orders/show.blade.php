@extends('layouts.admin')
@section('title', 'Détails de la commande')
@section('page_title', 'Détails de commande')

@section('content')
<div class="max-w-site mx-auto">
    <div class="mb-8 flex items-center gap-4">
        <a href="{{ route('admin.orders.index') }}" class="p-2 bg-surface border border-outline-variant/30 rounded-full hover:text-secondary transition-colors">
            <span class="material-symbols-outlined">arrow_back</span>
        </a>
        <div>
                <h2 class="font-serif text-h2 text-primary">Commande #{{ $order->numero }}</h2>
        <div class="bg-surface border border-outline-variant/30 p-6 rounded-lg">
            <h3 class="font-sans text-sm uppercase tracking-widest text-on-surface-variant mb-4">Informations de livraison</h3>
            <p class="font-semibold text-primary">{{ $order->shipping_name }}</p>
            <p class="text-sm text-on-surface-variant">{{ $order->shipping_address }}</p>
            <p class="text-sm text-on-surface-variant mt-3">{{ $order->shipping_email }}</p>
            <p class="text-sm text-on-surface-variant">{{ $order->shipping_telephone }}</p>
        </div>
        <div class="bg-surface border border-outline-variant/30 p-6 rounded-lg">
            <h3 class="font-sans text-sm uppercase tracking-widest text-on-surface-variant mb-4">Résumé de la commande</h3>
            <div class="space-y-2 text-sm text-on-surface-variant">
                <div class="flex justify-between"><span>Sous-total</span><span>{{ number_format($order->subtotal,0,',',' ') }} FCFA</span></div>
                <div class="flex justify-between"><span>Taxes</span><span>{{ number_format($order->taxes,0,',',' ') }} FCFA</span></div>
                <div class="flex justify-between"><span>Total</span><span class="font-semibold text-primary">{{ number_format($order->total,0,',',' ') }} FCFA</span></div>
                <div class="flex justify-between"><span>Statut</span><span class="font-semibold">{{ ucfirst(str_replace('_',' ', $order->status)) }}</span></div>
                <div class="flex justify-between"><span>Moyen de paiement</span><span>{{ ucfirst(str_replace('_',' ', $order->payment_method)) }}</span></div>
            </div>
        </div>
        <div class="bg-surface border border-outline-variant/30 p-6 rounded-lg">
            <h3 class="font-sans text-sm uppercase tracking-widest text-on-surface-variant mb-4">Actions</h3>
         <form method="POST" action="{{ route('admin.orders.updateStatus.post', $order->id) }}">
    @csrf
    <label class="text-caption uppercase tracking-widest text-on-surface-variant mb-2 block">Changer le statut</label>
    <select name="statut" class="w-full border border-outline-variant p-3 rounded-lg bg-surface focus:border-secondary">
        <option value="en_attente" {{ $order->statut === 'en_attente' ? 'selected' : '' }}>En attente</option>
        <option value="paye"       {{ $order->statut === 'paye'       ? 'selected' : '' }}>Payé</option>
        <option value="annule"     {{ $order->statut === 'annule'     ? 'selected' : '' }}>Annulé</option>
    </select>
    <button type="submit" class="btn-primary w-full mt-4">Mettre à jour</button>
</form>
        </div>
    </div>

    <div class="bg-surface border border-outline-variant/30 rounded-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-outline-variant/30 bg-surface">
            <h3 class="font-serif text-h3 text-primary">Articles commandés</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b border-outline-variant/30">
                        <th class="px-4 py-3 text-caption uppercase tracking-widest text-on-surface-variant font-semibold">Produit</th>
                        <th class="px-4 py-3 text-caption uppercase tracking-widest text-on-surface-variant font-semibold">Qté</th>
                        <th class="px-4 py-3 text-caption uppercase tracking-widest text-on-surface-variant font-semibold">Prix</th>
                        <th class="px-4 py-3 text-caption uppercase tracking-widest text-on-surface-variant font-semibold">Total</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant/20">
                    @foreach($order->items as $item)
                    <tr>
                        <td class="px-4 py-4 font-sans text-sm text-primary">{{ $item->product_name }} @if($item->couleur)<span class="text-caption text-on-surface-variant">({{ $item->couleur }})</span>@endif</td>
                        <td class="px-4 py-4 font-sans text-sm text-on-surface-variant">{{ $item->quantite }}</td>
                        <td class="px-4 py-4 font-sans text-sm text-primary">{{ number_format($item->prix_unitaire,0,',',' ') }} FCFA</td>
                        <td class="px-4 py-4 font-sans text-sm font-semibold text-primary">{{ number_format($item->total,0,',',' ') }} FCFA</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
