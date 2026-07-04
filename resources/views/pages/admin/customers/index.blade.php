@extends('layouts.admin')

@section('page_title', 'Gestion Clients')

@section('content')
<div class="flex flex-col gap-6">

    @if(session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-3 rounded-lg">{{ session('success') }}</div>
    @endif

    <h2 class="font-serif text-h2 text-primary">Liste des clients</h2>

    <div class="bg-surface border border-outline-variant/30 rounded-lg overflow-hidden shadow-card">
        <table class="w-full text-left border-collapse">
            <thead class="bg-surface-container text-caption uppercase tracking-widest text-on-surface-variant font-semibold">
                <tr class="border-b border-outline-variant/30">
                    <th class="px-6 py-3">Client</th>
                    <th class="px-6 py-3">Email</th>
                    <th class="px-6 py-3">Téléphone</th>
                    <th class="px-6 py-3">Commandes</th>
                    <th class="px-6 py-3 text-right">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-outline-variant/30">
                @forelse($clients as $client)
                <tr class="hover:bg-surface-container/50 transition-colors">
                    <td class="px-6 py-4 font-semibold text-primary">{{ $client->name }}</td>
                    <td class="px-6 py-4 text-on-surface-variant">{{ $client->email }}</td>
                    <td class="px-6 py-4 text-on-surface-variant">{{ $client->telephone ?? '—' }}</td>
                    <td class="px-6 py-4 text-on-surface-variant">{{ $client->orders_count }} commande(s)</td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('admin.customers.show', $client->id) }}"
                           class="text-secondary hover:underline text-sm font-semibold">
                            Voir profil
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-on-surface-variant">
                        Aucun client trouvé.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div>{{ $clients->links() }}</div>

</div>
@endsection
