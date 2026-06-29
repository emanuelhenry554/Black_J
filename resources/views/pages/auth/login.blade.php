{{-- ================================================================
     resources/views/pages/auth/login.blade.php
================================================================ --}}
@extends('layouts.app')
@section('title', 'Connexion')
@php $hideContactBar = true; @endphp

@section('content')
<div class="min-h-[80vh] flex items-center justify-center py-20 relative bg-cover bg-center" style="background-image: linear-gradient(rgba(0, 0, 0, 0.35), rgba(0, 0, 0, 0.35)), url('{{ asset('img/bg.jpeg') }}');">
    <div class="w-full max-w-md mx-auto px-px-mobile relative z-10">

        {{-- Logo --}}
        <div class="text-center mb-10">
            <a href="{{ route('home') }}" class="inline-flex flex-col items-center">
                <span class="font-serif text-5xl text-secondary" style="font-family:'Libre Caslon Text',serif">Bj</span>
                <span class="font-sans text-xs tracking-[0.25em] uppercase text-white/90 mt-1 font-semibold">Blac Joyaux</span>
            </a>
            <h1 class="font-serif text-h2 text-white mt-6">Connexion</h1>
            <p class="font-sans text-body text-white/70 mt-2">Accédez à votre espace personnel.</p>
        </div>

        {{-- Card --}}
        <div class="bg-surface-container-lowest border border-outline-variant/30 p-8 shadow-luxury">
            <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-6">
                @csrf

                {{-- Email --}}
                <div class="flex flex-col gap-1.5">
                    <label for="email" class="text-caption uppercase tracking-widest font-sans font-semibold text-primary">Adresse e-mail</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="email"
                           placeholder="aminata@example.com"
                           class="input-gold bg-surface border-0 border-b border-outline-variant px-0 py-2.5 font-sans text-body text-on-surface placeholder-outline-variant focus:ring-0">
                    @error('email')<p class="text-caption text-error">{{ $message }}</p>@enderror
                </div>

                {{-- Password --}}
                <div class="flex flex-col gap-1.5">
                    <div class="flex justify-between items-center">
                        <label for="password" class="text-caption uppercase tracking-widest font-sans font-semibold text-primary">Mot de passe</label>
                        @if(Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-caption text-secondary hover:underline font-sans">Mot de passe oublié ?</a>
                        @endif
                    </div>
                    <input type="password" id="password" name="password" required autocomplete="current-password"
                           placeholder="••••••••"
                           class="input-gold bg-surface border-0 border-b border-outline-variant px-0 py-2.5 font-sans text-body text-on-surface placeholder-outline-variant focus:ring-0">
                    @error('password')<p class="text-caption text-error">{{ $message }}</p>@enderror
                </div>

                {{-- Remember --}}
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="checkbox" name="remember" class="accent-secondary w-4 h-4">
                    <span class="font-sans text-body text-on-surface-variant">Rester connecté(e)</span>
                </label>

                <button type="submit" class="btn-primary w-full text-center">Se connecter</button>
            </form>

            <div class="mt-6 pt-6 border-t border-outline-variant/30 text-center">
                <p class="font-sans text-body text-on-surface-variant">
                    Pas encore de compte ?
                    <a href="{{ route('register') }}" class="text-secondary font-semibold hover:underline">Créer un compte</a>
                </p>
            </div>
        </div>

        <p class="text-center mt-8">
            <a href="{{ route('home') }}" class="text-caption uppercase tracking-widest text-white/80 hover:text-secondary transition-colors font-sans">
                ← Retour à l'accueil
            </a>
        </p>
    </div>
</div>
@endsection
