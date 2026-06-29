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
        <div class="bg-surface border border-outline-variant/30 p-6 rounded-lg shadow-card flex flex-col items-center text-center">
            <div class="w-24 h-24 rounded-full bg-secondary text-on-secondary flex items-center justify-center text-2xl font-bold mb-4">
                EH
            </div>
            <h3 class="font-semibold text-primary text-lg">Emmanuel Henry</h3>
            <p class="text-sm text-on-surface-variant mb-6">emmanuel@exemple.ci</p>
            <div class="w-full border-t border-outline-variant/30 pt-4 flex flex-col gap-3 text-left">
                <p class="text-xs text-on-surface-variant uppercase tracking-widest font-bold">Contact</p>
                <p class="text-sm text-primary">+225 07 00 00 00 00</p>
                <p class="text-sm text-primary">Abidjan, Riviera Palmeraie</p>
            </div>
        </div>

        <div class="md:col-span-2 flex flex-col gap-6">
            <div class="bg-surface border border-outline-variant/30 p-6 rounded-lg shadow-card">
                <h4 class="text-caption uppercase tracking-widest text-primary font-semibold mb-4">Historique des commandes</h4>
                <div class="flex flex-col gap-3">
                    <div class="flex items-center justify-between p-3 bg-surface-container rounded border border-outline-variant/20">
                        <div class="flex flex-col">
                            <span class="text-sm font-semibold text-primary">Commande #ORD-2026-001</span>
                            <span class="text-xs text-on-surface-variant">24 Juin 2026</span>
                        </div>
                        <span class="text-xs font-bold text-secondary uppercase tracking-widest">Livrée</span>
                    </div>
                    <div class="flex items-center justify-between p-3 bg-surface-container rounded border border-outline-variant/20">
                        <div class="flex flex-col">
                            <span class="text-sm font-semibold text-primary">Commande #ORD-2026-005</span>
                            <span class="text-xs text-on-surface-variant">12 Mai 2026</span>
                        </div>
                        <span class="text-xs font-bold text-on-surface-variant uppercase tracking-widest">En cours</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
