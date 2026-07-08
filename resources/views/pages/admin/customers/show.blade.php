@extends('layouts.admin')

@section('page_title', 'Fiche Client')

@section('content')
<div class="max-w-4xl mx-auto flex flex-col gap-8">
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.customers.index') }}" class="p-2 bg-surface border border-outline-variant/30 rounded-full hover:text-secondary transition-colors">
                <span class="material-symbols-outlined">arrow_back</span>
            </a>
            <h2 class="font-serif text-h2 text-primary">Détails Client</h2>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

        {{-- Profil client --}}
        <div class="bg-surface border border-outline-variant/30 p-6 rounded-lg shadow-card flex flex-col items-center text-center">
            <div class="w-24 h-24 rounded-full bg-secondary text-on-secondary flex items-center justify-center text-2xl font-bold mb-4">
                {{ strtoupper(substr($client->name, 0, 2)) }}
            </div>
            <h3 class="font-semibold text-primary text-lg">{{ $client->name }}</h3>
            <p class="text-sm text-on-surface-variant mb-6">{{ $client->email }}</p>
            <div class="w-full border-t border-outline-variant/30 pt-4 flex flex-col gap-3 text-left">
                <p class="text-xs text-on-surface-variant uppercase tracking-widest font-bold">Contact</p>
                <p class="text-sm text-primary">{{ $client->telephone ?? '—' }}</p>
                <p class="text-xs text-on-surface-variant uppercase tracking-widest font-bold mt-2">Membre depuis</p>
                <p class="text-sm text-primary">{{ $client->created_at->format('d/m/Y') }}</p>
                <p class="text-xs text-on-surface-variant uppercase tracking-widest font-bold mt-2">Total commandes</p>
                <p class="text-sm text-primary">{{ $commandes->count() }} commande(s)</p>
            </div>
        </div>

        {{-- Historique commandes --}}
        <div class="md:col-span-2 flex flex-col gap-6">
            <div class="bg-surface border border-outline-variant/30 p-6 rounded-lg shadow-card">
                <h4 class="text-caption uppercase tracking-widest text-primary font-semibold mb-4">
                    Historique des commandes
                </h4>
                <div class="flex flex-col gap-3">
                    @forelse($commandes as $commande)
                    <div class="flex items-center justify-between p-3 bg-surface rounded border border-outline-variant/20">
                        <div class="flex flex-col">
                            <span class="text-sm font-semibold text-primary">
                                Commande #{{ $commande->numero_commande }}
                            </span>
                            <span class="text-xs text-on-surface-variant">
                                {{ $commande->created_at->format('d/m/Y') }}
                                — {{ number_format($commande->total, 0, ',', ' ') }} FCFA
                            </span>
                            <span class="text-xs text-on-surface-variant mt-1">
                                {{ $commande->items->count() }} article(s)
                            </span>
                        </div>
                        <span class="text-xs font-bold uppercase tracking-widest
                            {{ $commande->statut === 'paye' ? 'text-green-600' :
                               ($commande->statut === 'annule' ? 'text-red-500' : 'text-yellow-600') }}">
                            {{ ucfirst($commande->statut) }}
                        </span>
                    </div>
                    @empty
                    <p class="text-sm text-on-surface-variant">Aucune commande pour ce client.</p>
                    @endforelse
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
