@extends('layouts.app')

@section('title', 'Mot de passe oublié — Blac Joyaux')

@section('content')
<div class="flex items-center justify-center min-h-[70vh] px-px-mobile md:px-px-desktop">
    <div class="w-full max-w-md bg-surface border border-outline-variant/30 p-8 shadow-luxury">
        <div class="text-center mb-8">
            <h1 class="font-serif text-h2 text-primary mb-3">Récupération</h1>
            <p class="text-body text-on-surface-variant">Entrez votre adresse email pour recevoir un lien de réinitialisation.</p>
        </div>

        <form action="{{ route('password.email') }}" method="POST" class="flex flex-col gap-6">
            @csrf
            <div class="flex flex-col gap-2">
                <label class="text-caption uppercase tracking-widest text-on-surface-variant font-sans font-semibold">Email</label>
                <input type="email" name="email" required placeholder="email@exemple.com"
                       class="input-gold bg-surface px-4 py-3 border border-outline-variant focus:ring-0">
            </div>
            <button type="submit" class="btn-primary w-full">Envoyer le lien</button>
            <a href="{{ route('login') }}" class="text-center text-sm text-on-surface-variant hover:text-secondary transition-colors font-sans">
                Retour à la connexion
            </a>
        </form>
    </div>
</div>
@endsection
