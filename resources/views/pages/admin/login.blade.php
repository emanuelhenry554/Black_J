@extends('layouts.app')
@section('title', 'Connexion Admin')
@php $hideContactBar = true; @endphp

@section('content')
<div class="min-h-[80vh] flex items-center justify-center py-20 relative bg-surface">
    <div class="w-full max-w-md mx-auto px-px-mobile relative z-10">
        <div class="text-center mb-10">
            <a href="{{ route('home') }}" class="inline-flex flex-col items-center">
                <img src="{{ asset('img/logo.png') }}" alt="Blac Joyaux Logo" class="h-16 md:h-20 w-auto object-contain">
                <span class="font-sans text-xs tracking-[0.25em] uppercase text-on-surface-variant mt-3 font-semibold">Blac Joyaux</span>
            </a>
            <h1 class="font-serif text-h2 text-primary mt-6">Connexion Admin</h1>
            <p class="font-sans text-body text-on-surface-variant mt-2">Accédez à l'administration Blac Joyaux.</p>
        </div>

        <div class="bg-surfaceest border border-outline-variant/30 p-8 shadow-luxury">
            <form method="POST" action="{{ route('admin.login.store') }}" class="flex flex-col gap-6">
                @csrf

                <div class="flex flex-col gap-1.5">
                    <label for="email" class="text-caption uppercase tracking-widest font-sans font-semibold text-primary">Adresse e-mail</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="email"
                           placeholder="admin@example.com"
                           class="input-gold bg-surface border-0 border-b border-outline-variant px-0 py-2.5 font-sans text-body text-on-surface placeholder-outline-variant focus:ring-0">
                    @error('email')<p class="text-caption text-error">{{ $message }}</p>@enderror
                </div>

                <div class="flex flex-col gap-1.5">
                    <label for="password" class="text-caption uppercase tracking-widest font-sans font-semibold text-primary">Mot de passe</label>
                    <input type="password" id="password" name="password" required autocomplete="current-password"
                           placeholder="••••••••"
                           class="input-gold bg-surface border-0 border-b border-outline-variant px-0 py-2.5 font-sans text-body text-on-surface placeholder-outline-variant focus:ring-0">
                    @error('password')<p class="text-caption text-error">{{ $message }}</p>@enderror
                </div>

                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="checkbox" name="remember" class="accent-secondary w-4 h-4">
                    <span class="font-sans text-body text-on-surface-variant">Rester connecté(e)</span>
                </label>

                <button type="submit" class="btn-primary w-full text-center">Se connecter</button>
            </form>

            <div class="mt-6 pt-6 border-t border-outline-variant/30 text-center">
                <p class="font-sans text-body text-on-surface-variant">
                    Retour au site ?
                    <a href="{{ route('home') }}" class="text-secondary font-semibold hover:underline">Accueil</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
