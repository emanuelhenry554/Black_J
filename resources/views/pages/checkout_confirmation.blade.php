@extends('layouts.app')
@section('title', 'Confirmation de commande')
@php $hideContactBar = true; @endphp

@section('content')
<div class="max-w-site mx-auto px-px-mobile md:px-px-desktop py-20 text-center">
    <div class="max-w-xl mx-auto bg-surface-container-low p-10 rounded-3xl border border-outline-variant/30 shadow-luxury">
        <span class="material-symbols-outlined text-[60px] text-secondary">check_circle</span>
        <h1 class="font-serif text-h1 text-primary mt-6">Merci pour votre commande !</h1>
<p class="font-sans text-body text-on-surface-variant mt-4">Votre commande <strong>{{ $order->numero_commande }}</strong> a bien été enregistrée. Nous préparons votre livraison dès maintenant.</p>
        <div class="mt-8 flex flex-col gap-4 sm:flex-row justify-center">
            <a href="{{ route('home') }}" class="btn-outline">Retour à l'accueil</a>
            <a href="{{ route('profile.index') }}" class="btn-primary">Voir mon compte</a>
        </div>
    </div>
</div>
@endsection
