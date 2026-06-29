@extends('layouts.app')
@section('title', 'Mon Profil')

@section('content')
<div class="max-w-site mx-auto px-px-mobile md:px-px-desktop py-10">

    <div class="mb-10 border-b border-outline-variant/30 pb-6">
        <p class="text-caption uppercase tracking-widest text-secondary font-sans font-semibold mb-2">Bienvenue,</p>
        <h1 class="font-serif text-h1 text-primary">{{ auth()->user()->name ?? 'Client Privilégié' }}</h1>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

        {{-- Sidebar nav --}}
        <nav class="lg:col-span-1 flex flex-row lg:flex-col gap-2 overflow-x-auto pb-2 lg:pb-0 -mx-px-mobile px-px-mobile lg:mx-0 lg:px-0">
            @foreach([
                ['profile.index',   'person',        'Mon compte'],
                ['profile.orders',  'receipt_long',  'Mes commandes'],
                ['profile.wishlist','favorite',      'Mes favoris'],
                ['profile.addresses','location_on',  'Mes adresses'],
            ] as [$route, $icon, $label])
            <a href="{{ route($route) }}"
               class="flex-shrink-0 flex items-center gap-3 px-4 py-3 text-caption uppercase tracking-widest font-sans font-semibold transition-colors
                      {{ request()->routeIs($route) ? 'bg-primary text-on-primary' : 'bg-surface-container text-on-surface-variant hover:bg-surface-dim' }}">
                <span class="material-symbols-outlined text-[18px]">{{ $icon }}</span>
                <span class="hidden sm:block">{{ $label }}</span>
            </a>
            @endforeach
            <form method="POST" action="{{ route('logout') }}" class="flex-shrink-0">
                @csrf
                <button type="submit" class="flex items-center gap-3 px-4 py-3 text-caption uppercase tracking-widest font-sans font-semibold text-on-surface-variant hover:text-error hover:bg-error-container transition-colors w-full">
                    <span class="material-symbols-outlined text-[18px]">logout</span>
                    <span class="hidden sm:block">Déconnexion</span>
                </button>
            </form>
        </nav>

        {{-- Main content --}}
        <div class="lg:col-span-3">
            @yield('profile_content')

            {{-- Default: show profile info --}}
            @if(!View::hasSection('profile_content'))
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                {{-- Personal info --}}
                <div class="bg-surface-container-low p-6">
                    <div class="flex justify-between items-start mb-6 pb-4 border-b border-outline-variant/30">
                        <h2 class="font-serif text-h2 text-primary">Informations</h2>
                        <a href="#edit" class="text-caption text-secondary hover:underline font-sans font-semibold uppercase tracking-widest">Modifier</a>
                    </div>
                    <form method="POST" action="{{ route('profile.update') }}" class="flex flex-col gap-5">
                        @csrf @method('PATCH')
                        @foreach([
                            ['name',      'Nom complet',   'text',  auth()->user()->name ?? 'Jean Dupont'],
                            ['email',     'E-mail',        'email', auth()->user()->email ?? 'email@exemple.ci'],
                            ['telephone', 'Téléphone',     'tel',   auth()->user()->telephone ?? ''],
                        ] as [$name, $label, $type, $value])
                        <div class="flex flex-col gap-1.5">
                            <label for="{{ $name }}" class="text-caption uppercase tracking-widest font-sans font-semibold text-primary">{{ $label }}</label>
                            <input type="{{ $type }}" id="{{ $name }}" name="{{ $name }}" value="{{ $value }}"
                                   class="input-gold bg-surface border-0 border-b border-outline-variant px-0 py-2.5 font-sans text-body text-on-surface focus:ring-0">
                        </div>
                        @endforeach
                        <button type="submit" class="btn-primary self-start mt-2">Enregistrer</button>
                    </form>
                </div>

                {{-- Password --}}
                <div class="bg-surface-container-low p-6">
                    <h2 class="font-serif text-h2 text-primary mb-6 pb-4 border-b border-outline-variant/30">Mot de passe</h2>
                    <form method="POST" action="{{ route('profile.password') }}" class="flex flex-col gap-5">
                        @csrf @method('PATCH')
                        @foreach([
                            ['current_password',      'Mot de passe actuel'],
                            ['password',              'Nouveau mot de passe'],
                            ['password_confirmation', 'Confirmer'],
                        ] as [$name, $label])
                        <div class="flex flex-col gap-1.5">
                            <label for="{{ $name }}" class="text-caption uppercase tracking-widest font-sans font-semibold text-primary">{{ $label }}</label>
                            <input type="password" id="{{ $name }}" name="{{ $name }}" placeholder="••••••••"
                                   class="input-gold bg-surface border-0 border-b border-outline-variant px-0 py-2.5 font-sans text-body text-on-surface focus:ring-0">
                            @error($name)<p class="text-caption text-error">{{ $message }}</p>@enderror
                        </div>
                        @endforeach
                        <button type="submit" class="btn-outline self-start mt-2">Changer</button>
                    </form>
                </div>

                {{-- Recent orders --}}
                <div class="md:col-span-2 bg-surface-container-low p-6">
                    <div class="flex justify-between items-center mb-6 pb-4 border-b border-outline-variant/30">
                        <h2 class="font-serif text-h2 text-primary">Commandes récentes</h2>
                        <a href="{{ route('profile.orders') }}" class="text-caption text-secondary hover:underline font-sans font-semibold uppercase tracking-widest">Tout voir</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="border-b border-outline-variant/30">
                                    @foreach(['Commande', 'Date', 'Articles', 'Total', 'Statut'] as $h)
                                    <th class="text-caption uppercase tracking-widest text-on-surface-variant pb-3 pr-6 font-sans font-semibold">{{ $h }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-outline-variant/20">
                                <tr>
                                    <td class="py-4 pr-6 font-sans text-sm font-semibold text-primary">#ORD-2026-001</td>
                                    <td class="py-4 pr-6 font-sans text-sm text-on-surface-variant">24/06/2026</td>
                                    <td class="py-4 pr-6 font-sans text-sm text-on-surface-variant">1</td>
                                    <td class="py-4 pr-6 font-sans text-sm font-semibold text-primary">120 000 FCFA</td>
                                    <td class="py-4">
                                        <span class="px-2 py-1 text-[10px] font-bold uppercase rounded bg-green-100 text-green-700 border border-green-200">Livrée</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
