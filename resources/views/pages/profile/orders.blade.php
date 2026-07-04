@extends('pages.profile')

@section('profile_content')
<div class="flex flex-col gap-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="font-serif text-h2 text-primary">Historique des Commandes</h2>
        <span class="text-caption text-on-surface-variant uppercase tracking-widest font-semibold"> la totalité de vos achats</span>
    </div>

    <div class="flex flex-col gap-4">
        @forelse($orders as $order)
        @php
            $statusMap = [
                'en_attente' => ['label' => 'En attente', 'style' => 'bg-yellow-100 text-yellow-700 border-yellow-200'],
                'en_cours'   => ['label' => 'En cours',   'style' => 'bg-blue-100 text-blue-700 border-blue-200'],
                'livree'     => ['label' => 'Livrée',     'style' => 'bg-green-100 text-green-700 border-green-200'],
                'annulee'    => ['label' => 'Annulée',    'style' => 'bg-red-100 text-red-700 border-red-200'],
            ];
            $status = $statusMap[$order->status ?? 'en_attente'];
        @endphp
        <div class="bg-surface border border-outline-variant/30 p-6 rounded-lg shadow-card flex flex-col md:flex-row justify-between gap-6">
            <div class="flex gap-4">
                <div class="w-16 h-16 bg-surface-container rounded overflow-hidden flex-shrink-0">
                    <span class="material-symbols-outlined w-full h-full flex items-center justify-center text-outline-variant">shopping_bag</span>
                </div>
                <div class="flex flex-col gap-1">
                    <span class="font-semibold text-primary">Commande #{{ $order->numero }}</span>
                    <span class="text-xs text-on-surface-variant">Passée le {{ $order->created_at->format('d M Y') }}</span>
                </div>
            </div>
            <div class="flex flex-col items-end gap-2">
                <span class="font-sans text-body font-bold text-primary">{{ number_format($order->total, 0, ',', ' ') }} FCFA</span>
                <span class="px-2 py-1 text-[10px] font-bold uppercase rounded border {{ $status['style'] }}">{{ $status['label'] }}</span>
            </div>
        </div>
        @empty
        <div class="bg-surface border border-outline-variant/30 p-6 rounded-lg shadow-card text-center text-on-surface-variant">
            Vous n'avez aucune commande pour le moment.
        </div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $orders->links() }}
    </div>
</div>
@endsection
