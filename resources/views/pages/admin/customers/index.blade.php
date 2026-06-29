@extends('layouts.admin')

@section('page_title', 'Gestion Clients')

@section('content')
<div class="flex flex-col gap-6">
    <h2 class="font-serif text-h2 text-primary">Liste des clients</h2>
    <div class="bg-surface border border-outline-variant/30 rounded-lg overflow-hidden shadow-card">
        <table class="w-full text-left border-collapse">
            <thead class="bg-surface-container text-caption uppercase tracking-widest text-on-surface-variant font-semibold">
                <tr class="border-b border-outline-variant/30">
                    <th class="px-6 py-3">Client</th>
                    <th class="px-6 py-3">Email</th>
                    <th class="px-6 py-3">Commandes</th>
                    <th class="px-6 py-3 text-right">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-outline-variant/30">
                <tr class="hover:bg-surface-container/50 transition-colors">
                    <td class="px-6 py-4 font-semibold text-primary">Emmanuel Henry</td>
                    <td class="px-6 py-4 text-on-surface-variant">emmanuel@exemple.ci</td>
                    <td class="px-6 py-4 text-on-surface-variant">3 commandes</td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('admin.customers.show', 1) }}" class="text-secondary hover:underline text-sm font-semibold">Voir profil l'historique l'utilisateur</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
