@extends('layouts.admin')
@section('title', 'Vue d\'ensemble')
@section('page_title', 'Vue d\'ensemble')

@section('content')

{{-- Stats grid --}}
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    @foreach([
        ['receipt_long', 'Commandes',   $stats['commandes']  ?? 0,  'Ce mois', 'text-blue-600',   'bg-blue-50'],
        ['payments',     'Revenus',     number_format($stats['revenus'] ?? 0, 0, ',', ' ').' FCFA', 'Ce mois', 'text-secondary', 'bg-secondary-container'],
        ['group',        'Clients',     $stats['clients']    ?? 0,  'Total',   'text-purple-600', 'bg-purple-50'],
        ['inventory_2',  'Produits',    $stats['produits']   ?? 0,  'En stock','text-green-600',  'bg-green-50'],
    ] as [$icon, $label, $value, $sub, $color, $bg])
    <div class="bg-surface p-5 border border-outline-variant/30">
        <div class="flex items-start justify-between mb-4">
            <div class="{{ $bg }} p-2">
                <span class="material-symbols-outlined {{ $color }} text-[22px]">{{ $icon }}</span>
            </div>
        </div>
        <p class="font-sans text-2xl font-bold text-primary leading-tight mb-1">{{ $value }}</p>
        <p class="text-caption uppercase tracking-widest text-on-surface-variant font-sans font-semibold">{{ $label }}</p>
        <p class="text-caption text-on-surface-variant mt-1">{{ $sub }}</p>
    </div>
    @endforeach
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- Recent orders --}}
    <div class="lg:col-span-2 bg-surface border border-outline-variant/30">
        <div class="flex items-center justify-between px-6 py-4 border-b border-outline-variant/30">
            <h2 class="font-serif text-h2 text-primary">Commandes récentes</h2>
            <a href="{{ route('admin.orders.index') }}" class="text-caption text-secondary hover:underline font-sans font-semibold uppercase tracking-widest">Tout voir</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-outline-variant/30 bg-surface-container-low">
                        @foreach(['#', 'Client', 'Total', 'Statut', ''] as $h)
                        <th class="text-left text-caption uppercase tracking-widest text-on-surface-variant px-4 py-3 font-sans font-semibold">{{ $h }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant/20">
                    @forelse($recentOrders ?? [] as $order)
                    <tr class="hover:bg-surface-container-low transition-colors">
                        <td class="px-4 py-3 font-sans text-sm font-semibold text-primary">#{{ $order->numero }}</td>
                        <td class="px-4 py-3">
                            <p class="font-sans text-sm font-semibold text-primary">{{ $order->client->name ?? 'N/A' }}</p>
                            <p class="text-caption text-on-surface-variant">{{ $order->created_at->format('d/m/Y') }}</p>
                        </td>
                        <td class="px-4 py-3 font-sans text-sm font-semibold text-primary">{{ number_format($order->total, 0, ',', ' ') }} FCFA</td>
                        <td class="px-4 py-3">
                            @php
                            $statusMap = [
                                'en_attente' => ['label' => 'En attente',  'style' => 'background:#f5e6c8;color:#6b4f10'],
                                'en_cours'   => ['label' => 'En cours',    'style' => 'background:#dbeafe;color:#1d4ed8'],
                                'livree'     => ['label' => 'Livrée',      'style' => 'background:#dcfce7;color:#15803d'],
                                'annulee'    => ['label' => 'Annulée',     'style' => 'background:#ffdad6;color:#93000a'],
                            ];
                            $st = $statusMap[$order->status ?? 'en_attente'];
                            @endphp
                            <span class="inline-block px-2 py-0.5 text-[11px] font-sans font-semibold uppercase tracking-widest" style="{{ $st['style'] }}">{{ $st['label'] }}</span>
                        </td>
                        <td class="px-4 py-3">
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="text-secondary hover:underline text-caption font-sans font-semibold">Voir</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-4 py-10 text-center text-on-surface-variant font-sans text-sm">Aucune commande récente.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Top products + Quick actions --}}
    <div class="flex flex-col gap-6">
        {{-- Quick actions --}}
        <div class="bg-surface border border-outline-variant/30 p-6">
            <h2 class="font-serif text-h2 text-primary mb-5">Actions rapides</h2>
            <div class="flex flex-col gap-2">
                <a href="{{ route('admin.products.create') }}" class="btn-primary block text-center">
                    + Ajouter un produit
                </a>
                <a href="{{ route('admin.orders.index') }}?status=en_attente" class="btn-outline block text-center">
                    Commandes en attente
                </a>
            </div>
        </div>

        {{-- Low stock --}}
        <div class="bg-surface border border-outline-variant/30">
            <div class="px-6 py-4 border-b border-outline-variant/30 flex items-center justify-between">
                <h2 class="font-serif text-h2 text-primary">Stock faible</h2>
                <a href="{{ route('admin.inventory.index') }}" class="text-caption text-secondary hover:underline font-sans font-semibold uppercase tracking-widest">Gérer</a>
            </div>
            <div class="divide-y divide-outline-variant/20">
                @forelse($lowStockProducts ?? [] as $product)
                <div class="flex items-center justify-between px-6 py-3">
                    <div>
                        <p class="font-sans text-sm font-semibold text-primary">{{ $product->nom }}</p>
                        <p class="text-caption text-on-surface-variant">{{ $product->categorie->nom ?? '' }}</p>
                    </div>
                    <span class="text-caption font-bold {{ $product->stock === 0 ? 'text-error' : 'text-secondary' }} font-sans">
                        {{ $product->stock }} restant(s)
                    </span>
                </div>
                @empty
                <p class="px-6 py-6 text-center text-sm text-on-surface-variant font-sans">Aucun produit en rupture.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
