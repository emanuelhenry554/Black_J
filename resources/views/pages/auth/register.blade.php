@extends('layouts.app')
@section('title', 'Créer un compte')
@php $hideContactBar = true; @endphp

@section('content')
<div class="min-h-[80vh] flex items-center justify-center py-20 relative bg-cover bg-center" style="background-image: linear-gradient(rgba(0, 0, 0, 0.35), rgba(0, 0, 0, 0.35)), url('{{ asset('img/bg.jpeg') }}');">
    <div class="w-full max-w-md mx-auto px-px-mobile relative z-10">

        <div class="text-center mb-10">
            <a href="{{ route('home') }}" class="inline-flex flex-col items-center">
                <span class="font-serif text-5xl text-secondary" style="font-family:'Libre Caslon Text',serif">Bj</span>
                <span class="font-sans text-xs tracking-[0.25em] uppercase text-white/90 mt-1 font-semibold">Blac Joyaux</span>
            </a>
            <h1 class="font-serif text-h2 text-white mt-6">Créer un compte</h1>
            <p class="font-sans text-body text-white/70 mt-2">Rejoignez le cercle Blac Joyaux.</p>
        </div>

        <div class="bg-surface-container-lowest border border-outline-variant/30 p-8 shadow-luxury">
            <form method="POST" action="{{ route('register') }}" class="flex flex-col gap-6">
                @csrf

                @foreach([
                    ['name',                  'Nom complet',         'text',     'Aminata Koné',          'name'],
                    ['email',                 'Adresse e-mail',      'email',    'aminata@example.com',   'email'],
                    ['telephone',             'Téléphone',           'tel',      '+225 07 00 00 00 00',   'tel'],
                    ['password',              'Mot de passe',        'password', '••••••••',              'new-password'],
                    ['password_confirmation', 'Confirmer le MDP',   'password', '••••••••',              'new-password'],
                ] as [$name, $label, $type, $placeholder, $autocomplete])
                <div class="flex flex-col gap-1.5">
                    <label for="{{ $name }}" class="text-caption uppercase tracking-widest font-sans font-semibold text-primary">{{ $label }}</label>
                    <input type="{{ $type }}" id="{{ $name }}" name="{{ $name }}"
                           value="{{ in_array($type, ['password']) ? '' : old($name) }}" required
                           placeholder="{{ $placeholder }}" autocomplete="{{ $autocomplete }}"
                           class="input-gold bg-surface border-0 border-b border-outline-variant px-0 py-2.5 font-sans text-body text-on-surface placeholder-outline-variant focus:ring-0">
                    @error($name)<p class="text-caption text-error">{{ $message }}</p>@enderror
                </div>
                @endforeach

                <label class="flex items-start gap-3 cursor-pointer">
                    <input type="checkbox" name="accept_terms" required class="accent-secondary w-4 h-4 mt-0.5 flex-shrink-0">
                    <span class="font-sans text-sm text-on-surface-variant leading-relaxed">
                        J'accepte les <a href="#" class="text-secondary hover:underline">conditions générales</a> et la <a href="#" class="text-secondary hover:underline">politique de confidentialité</a>.
                    </span>
                </label>

                <button type="submit" class="btn-primary w-full text-center">Créer mon compte</button>
            </form>

            <div class="mt-6 pt-6 border-t border-outline-variant/30 text-center">
                <p class="font-sans text-body text-on-surface-variant">
                    Déjà un compte ?
                    <a href="{{ route('login') }}" class="text-secondary font-semibold hover:underline">Se connecter</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
