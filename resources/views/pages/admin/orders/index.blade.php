{{-- ================================================================
     resources/views/pages/admin/orders/index.blade.php
================================================================ --}}
@extends('layouts.admin')
@section('title', 'Commandes')
@section('page_title', 'Commandes')

@section('content')

{{-- Filters --}}
<div class="flex flex-col sm:flex-row gap-3 mb-6 items-start sm:items-center">
    <div class="flex gap-2 overflow-x-auto">
        @foreach(['Toutes' => '', 'En attente' => 'en_attente', 'En cours' => 'en_cours', 'Livrées' => 'livree', 'Annulées' => 'annulee'] as $label => $val)
        <a href="{{ route('admin.orders.index', array_merge(request()->except('statut','page'), $val ? ['statut' => $val] : [])) }}"
           class="flex-shrink-0 px-4 py-2 text-caption uppercase tracking-widest font-sans font-semibold transition-colors
                  {{ request('statut', '') === $val ? 'bg-primary text-on-primary' : 'bg-surface border border-outline-variant text-on-surface-variant hover:border-secondary' }}">
            {{ $label }}
        </a>
        @endforeach
    </div>
    <form method="GET" action="{{ route('admin.orders.index') }}" class="flex gap-2 sm:ml-auto">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Rechercher…"
               class="border border-outline-variant px-3 py-2 text-sm font-sans focus:border-secondary focus:outline-none bg-surface">
        <button type="submit" class="btn-primary px-4 py-2 text-sm">Chercher</button>
    </form>
</div>

<div class="bg-surface border border-outline-variant/30 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-surface-container-low border-b border-outline-variant/30">
                    @foreach(['Commande', 'Client', 'Date', 'Articles', 'Total', 'Statut', 'Actions'] as $h)
                    <th class="text-left text-caption uppercase tracking-widest text-on-surface-variant px-4 py-3 font-sans font-semibold whitespace-nowrap">{{ $h }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody class="divide-y divide-outline-variant/20">
                @forelse($orders ?? [] as $order)
                @php
                $statusMap = [
                    'en_attente' => ['label' => 'En attente',  'style' => 'background:#f5e6c8;color:#6b4f10'],
                    'en_cours'   => ['label' => 'En cours',    'style' => 'background:#dbeafe;color:#1d4ed8'],
                    'livree'     => ['label' => 'Livrée',      'style' => 'background:#dcfce7;color:#15803d'],
                    'annulee'    => ['label' => 'Annulée',     'style' => 'background:#ffdad6;color:#93000a'],
                ];
                $st = $statusMap[$order->statut ?? 'en_attente'];
                @endphp
                <tr class="hover:bg-surface-container-low transition-colors">
                    <td class="px-4 py-3 font-sans text-sm font-bold text-primary">#{{ $order->numero }}</td>
                    <td class="px-4 py-3">
                        <p class="font-sans text-sm font-semibold text-primary">{{ $order->client->name ?? 'N/A' }}</p>
                        <p class="text-caption text-on-surface-variant">{{ $order->client->email ?? '' }}</p>
                    </td>
                    <td class="px-4 py-3 font-sans text-sm text-on-surface-variant whitespace-nowrap">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                    <td class="px-4 py-3 font-sans text-sm text-primary">{{ $order->items_count ?? 0 }}</td>
                    <td class="px-4 py-3 font-sans text-sm font-bold text-primary whitespace-nowrap">{{ number_format($order->total, 0, ',', ' ') }} FCFA</td>
                    <td class="px-4 py-3">
                        <span class="inline-block px-2 py-0.5 text-[11px] font-sans font-semibold uppercase tracking-widest" style="{{ $st['style'] }}">{{ $st['label'] }}</span>
                    </td>
                    <td class="px-4 py-3">
                        <a href="{{ route('admin.orders.show', $order->id) }}" class="text-secondary hover:underline text-caption font-sans font-semibold">Voir</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-4 py-12 text-center text-on-surface-variant font-sans">Aucune commande trouvée.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if(isset($orders) && $orders->hasPages())
    <div class="px-6 py-4 border-t border-outline-variant/30 flex justify-end">
        {{ $orders->links() }}
    </div>
    @endif
</div>
@endsection
