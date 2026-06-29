@extends('layouts.app')

@section('title', 'Contact — Blac Joyaux')
@section('meta_description', 'Contactez la maison Blac Joyaux pour toute demande d\'information ou commande personnalisée.')

@section('content')
<div class="bg-surface-container-low border-b border-outline-variant/30 py-10 pattern-bg">
    <div class="max-w-site mx-auto px-px-mobile md:px-px-desktop text-center">
        <p class="text-caption uppercase tracking-widest text-secondary font-sans font-semibold mb-3">Nous contacter</p>
        <h1 class="font-serif text-h1 text-primary">Contact</h1>
        <div class="w-8 h-px bg-secondary mx-auto mt-4"></div>
    </div>
</div>

<div class="max-w-site mx-auto px-px-mobile md:px-px-desktop py-16 md:py-24">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
        {{-- Info --}}
        <div class="flex flex-col gap-10">
            <div>
                <h2 class="font-serif text-h2 text-primary mb-6">Nous sommes à votre écoute.</h2>
                <p class="font-sans text-body text-on-surface-variant leading-relaxed mb-8">
                    Que ce soit pour une question sur une de nos collections, un suivi de commande ou une demande de création sur mesure, notre équipe est là pour vous accompagner.
                </p>
            </div>

            <div class="flex flex-col gap-6">
                <div class="flex items-start gap-4">
                    <span class="material-symbols-outlined text-secondary text-3xl">location_on</span>
                    <div>
                        <h4 class="text-caption uppercase tracking-widest text-primary font-sans font-semibold">Adresse</h4>
                        <p class="text-body text-on-surface-variant">Cocody Riviera Palmeraie, Abidjan, Côte d'Ivoire</p>
                    </div>
                </div>
                <div class="flex items-start gap-4">
                    <span class="material-symbols-outlined text-secondary text-3xl">mail</span>
                    <div>
                        <h4 class="text-caption uppercase tracking-widest text-primary font-sans font-semibold">Email</h4>
                        <p class="text-body text-on-surface-variant">contact@blacjoyaux.ci</p>
                    </div>
                </div>
                <div class="flex items-start gap-4">
                    <span class="material-symbols-outlined text-secondary text-3xl">chat</span>
                    <div>
                        <h4 class="text-caption uppercase tracking-widest text-primary font-sans font-semibold">WhatsApp</h4>
                        <p class="text-body text-on-surface-variant">+225 07 00 00 00 00</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Form --}}
        <div class="bg-surface border border-outline-variant/30 p-8 shadow-luxury">
            <form action="#" method="POST" class="flex flex-col gap-6">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="flex flex-col gap-2">
                        <label class="text-caption uppercase tracking-widest text-on-surface-variant font-sans font-semibold">Nom complet</label>
                        <input type="text" name="name" placeholder="Jean Dupont" class="input-gold bg-surface-container px-4 py-3 border border-outline-variant focus:ring-0">
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="text-caption uppercase tracking-widest text-on-surface-variant font-sans font-semibold">Email</label>
                        <input type="email" name="email" placeholder="email@exemple.com" class="input-gold bg-surface-container px-4 py-3 border border-outline-variant focus:ring-0">
                    </div>
                </div>
                <div class="flex flex-col gap-2">
                    <label class="text-caption uppercase tracking-widest text-on-surface-variant font-sans font-semibold">Sujet</label>
                    <input type="text" name="subject" placeholder="Demande d'information" class="input-gold bg-surface-container px-4 py-3 border border-outline-variant focus:ring-0">
                </div>
                <div class="flex flex-col gap-2">
                    <label class="text-caption uppercase tracking-widest text-on-surface-variant font-sans font-semibold">Message</label>
                    <textarea name="message" rows="5" placeholder="Votre message..." class="input-gold bg-surface-container px-4 py-3 border border-outline-variant focus:ring-0"></textarea>
                </div>
                <button type="submit" class="btn-primary w-full">Envoyer le message</button>
            </form>
        </div>
    </div>
</div>
@endsection
