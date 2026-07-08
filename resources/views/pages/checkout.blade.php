@extends('layouts.app')
@section('title', 'Paiement')
@php $hideContactBar = true; @endphp

@section('content')
<div class="max-w-site mx-auto px-px-mobile md:px-px-desktop py-10">

    <div class="mb-10">
        <h1 class="font-serif text-h1 text-primary">Finaliser la commande</h1>
    </div>

    {{-- Steps --}}
    <div class="flex items-center gap-0 mb-10 overflow-x-auto">
        @foreach(['Panier', 'Livraison', 'Paiement', 'Confirmation'] as $i => $step)
        <div class="flex items-center flex-shrink-0">
            <div class="flex items-center gap-2">
                <div class="w-7 h-7 flex items-center justify-center text-caption font-sans font-bold
                            {{ $i < 2 ? 'bg-primary text-on-primary' : ($i === 2 ? 'bg-secondary text-on-secondary' : 'bg-surface text-on-surface-variant') }}">
                    @if($i < 2)
                        <span class="material-symbols-outlined text-[14px]">check</span>
                    @else
                        {{ $i + 1 }}
                    @endif
                </div>
                <span class="text-caption uppercase tracking-widest font-sans font-semibold hidden sm:block
                             {{ $i === 2 ? 'text-secondary' : ($i < 2 ? 'text-primary' : 'text-on-surface-variant') }}">{{ $step }}</span>
            </div>
            @if(!$loop->last)
            <div class="w-8 h-px bg-outline-variant mx-3 flex-shrink-0"></div>
            @endif
        </div>
        @endforeach
    </div>

    <form method="POST" action="{{ route('checkout.process') }}" id="checkout-form">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

            {{-- LEFT: Delivery + Payment --}}
            <div class="lg:col-span-2 flex flex-col gap-8">

                {{-- Delivery --}}
                <div class="bg-surface p-6">
                    <h2 class="font-serif text-h2 text-primary mb-6 pb-4 border-b border-outline-variant/30">Informations de livraison</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        @foreach([
                            ['nom',       'Nom',        'text',  'Koné'],
                            ['prenom',    'Prénom',     'text',  'Aminata'],
                            ['email',     'Email',      'email', 'aminata@example.com'],
                            ['telephone', 'Téléphone',  'tel',   '+225 07 00 00 00 00'],
                        ] as [$name, $label, $type, $placeholder])
                        <div class="flex flex-col gap-1.5">
                            <label for="{{ $name }}" class="text-caption uppercase tracking-widest font-sans font-semibold text-primary">{{ $label }} *</label>
                            <input type="{{ $type }}" id="{{ $name }}" name="{{ $name }}" placeholder="{{ $placeholder }}"
                                   value="{{ old($name, auth()->user()->{$name} ?? '') }}" required
                                   class="input-gold bg-surface border-0 border-b border-outline-variant px-0 py-2.5 font-sans text-body text-on-surface placeholder-outline-variant focus:ring-0">
                            @error($name)
                            <p class="text-caption text-error">{{ $message }}</p>
                            @enderror
                        </div>
                        @endforeach

                        <div class="sm:col-span-2 flex flex-col gap-1.5">
                            <label for="adresse" class="text-caption uppercase tracking-widest font-sans font-semibold text-primary">Adresse de livraison *</label>
                            <input type="text" id="adresse" name="adresse" placeholder="Cocody Riviera Palmeraie, Rue des Fleurs"
                                   value="{{ old('adresse') }}" required
                                   class="input-gold bg-surface border-0 border-b border-outline-variant px-0 py-2.5 font-sans text-body text-on-surface placeholder-outline-variant focus:ring-0">
                            @error('adresse')
                            <p class="text-caption text-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-1.5">
                            <label for="commune" class="text-caption uppercase tracking-widest font-sans font-semibold text-primary">Commune *</label>
                            <select id="commune" name="commune" required
                                    class="input-gold bg-surface border-0 border-b border-outline-variant px-0 py-2.5 font-sans text-body text-on-surface focus:ring-0">
                                <option value="">Sélectionner…</option>
                                @foreach(['Cocody','Plateau','Marcory','Treichville','Yopougon','Abobo','Adjamé','Koumassi','Port-Bouët','Bingerville'] as $c)
                                <option value="{{ $c }}" {{ old('commune') === $c ? 'selected' : '' }}>{{ $c }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex flex-col gap-1.5">
                            <label for="ville" class="text-caption uppercase tracking-widest font-sans font-semibold text-primary">Ville *</label>
                            <input type="text" id="ville" name="ville" placeholder="Abidjan" value="{{ old('ville', 'Abidjan') }}" required
                                   class="input-gold bg-surface border-0 border-b border-outline-variant px-0 py-2.5 font-sans text-body text-on-surface placeholder-outline-variant focus:ring-0">
                        </div>

                        <div class="sm:col-span-2 flex flex-col gap-1.5">
                            <label for="notes" class="text-caption uppercase tracking-widest font-sans font-semibold text-primary">Instructions (optionnel)</label>
                            <textarea id="notes" name="notes" rows="2" placeholder="Ex: Appeler avant livraison…"
                                      class="input-gold bg-surface border border-outline-variant px-3 py-2.5 font-sans text-body text-on-surface placeholder-outline-variant focus:ring-0 resize-none">{{ old('notes') }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- Payment --}}
                <div class="bg-surface p-6">
                    <h2 class="font-serif text-h2 text-primary mb-6 pb-4 border-b border-outline-variant/30">Mode de paiement</h2>
                    <div class="flex flex-col gap-3">
                        @foreach([
                            ['wave',        'Wave',         'Paiement instantané via Wave'],
                            ['orange_money', 'Orange Money','Paiement via Orange Money'],
                            ['mtn_momo',    'MTN MoMo',     'Paiement via MTN Mobile Money'],
                            ['visa',        'Carte bancaire','Visa / Mastercard sécurisé'],
                            ['livraison',   'À la livraison','Paiement en espèces à la réception'],
                        ] as [$val, $label, $desc])
                        <label class="flex items-start gap-4 p-4 border border-outline-variant cursor-pointer hover:border-secondary transition-colors has-[:checked]:border-secondary has-[:checked]:bg-secondary-container/30">
                            <input type="radio" name="mode_paiement" value="{{ $val }}" class="mt-0.5 accent-secondary flex-shrink-0" {{ $val === 'wave' ? 'checked' : '' }}>
                            <div>
                                <p class="font-sans font-semibold text-body text-primary">{{ $label }}</p>
                                <p class="text-caption text-on-surface-variant">{{ $desc }}</p>
                            </div>
                        </label>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- RIGHT: Summary --}}
            <div class="lg:col-span-1">
                <div class="bg-surface p-6 sticky top-32">
                    <h2 class="font-serif text-h2 text-primary mb-6 pb-4 border-b border-outline-variant/30">Ma commande</h2>

                    @if(isset($cartItems))
                    <div class="flex flex-col gap-3 mb-6">
                        @foreach($cartItems as $item)
                        @php
                            $checkoutImage = $item['image_url'] ?? null;
                            if (empty($checkoutImage)) {
                                $rawImage = $item['image'] ?? null;
                                if ($rawImage) {
                                    if (str_starts_with($rawImage, 'http://') || str_starts_with($rawImage, 'https://')) {
                                        $checkoutImage = $rawImage;
                                    } elseif (str_starts_with($rawImage, 'storage/')) {
                                        $checkoutImage = asset($rawImage);
                                    } elseif (str_contains($rawImage, '/')) {
                                        $checkoutImage = asset('storage/' . $rawImage);
                                    } else {
                                        $checkoutImage = asset('img/' . $rawImage);
                                    }
                                } else {
                                    $checkoutImage = asset('img/sacs-blac-joyaux.jpg');
                                }
                            }
                        @endphp
                        <div class="flex items-start gap-3">
                            <div class="w-14 h-16 flex-shrink-0 bg-surface overflow-hidden">
                                @if($item['image'] ?? false)
                                <img src="{{ $checkoutImage }}" alt="{{ $item['nom'] }}" class="w-full h-full object-cover">
                                @endif
                            </div>
                            <div class="flex-grow min-w-0">
                                <p class="font-sans text-sm font-semibold text-primary leading-snug truncate">{{ $item['nom'] }}</p>
                                <p class="text-caption text-on-surface-variant">Qté : {{ $item['quantite'] }}</p>
                            </div>
                            <p class="font-sans text-sm text-primary font-semibold whitespace-nowrap">{{ number_format($item['prix'] * $item['quantite'], 0, ',', ' ') }}</p>
                        </div>
                        @endforeach
                    </div>
                    @endif

                    <div class="flex flex-col gap-2 mb-6 pt-4 border-t border-outline-variant/30">
                        <div class="flex justify-between text-sm">
                            <span class="text-on-surface-variant font-sans">Sous-total</span>
                            <span class="font-sans font-semibold text-primary">{{ number_format($subtotal ?? 0, 0, ',', ' ') }} FCFA</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-on-surface-variant font-sans">Livraison</span>
                            <span class="font-sans font-semibold text-secondary">{{ ($subtotal ?? 0) >= 100000 ? 'Gratuite' : '5 000 FCFA' }}</span>
                        </div>
                        <div class="h-px bg-outline-variant/30 my-1"></div>
                        <div class="flex justify-between">
                            <span class="font-serif text-h3 text-primary">Total</span>
                            <span class="font-serif text-h3 text-primary">{{ number_format(($subtotal ?? 0) + (($subtotal ?? 0) >= 100000 ? 0 : 5000), 0, ',', ' ') }} FCFA</span>
                        </div>
                    </div>

                    <button type="submit" class="btn-primary w-full text-center">
                        Confirmer la commande
                    </button>

                    <p class="text-caption text-on-surface-variant text-center mt-4 leading-relaxed">
                        En confirmant, vous acceptez nos <a href="#" class="underline hover:text-secondary">conditions générales</a>.
                    </p>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
