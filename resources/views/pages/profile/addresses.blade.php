@extends('pages.profile')

@section('profile_content')
<div class="flex flex-col gap-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="font-serif text-h2 text-primary">Mes Adresses</h2>
        <button class="btn-outline py-2 px-4 text-caption flex items-center gap-2">
            <span class="material-symbols-outlined text-[18px]">add</span> Ajouter une adresse
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        {{-- Address 1 --}}
        <div class="bg-surface border border-outline-variant/30 p-6 rounded-lg shadow-card relative">
            <div class="flex justify-between items-start mb-4">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-secondary">home</span>
                    <span class="text-caption uppercase tracking-widest text-primary font-bold">Principale</span>
                </div>
                <div class="flex gap-2">
                    <button class="text-on-surface-variant hover:text-primary transition-colors"><span class="material-symbols-outlined text-[18px]">edit</span></button>
                    <button class="text-on-surface-variant hover:text-error transition-colors"><span class="material-symbols-outlined text-[18px]">delete</span></button>
                </div>
            </div>
            <p class="font-sans text-body text-on-surface-variant leading-relaxed">
                Emmanuel Henry<br>
                Cocody Riviera Palmeraie, Rue des Orchidées<br>
                Villa 123, Abidjan, Côte d'Ivoire
            </p>
        </div>

        {{-- Address 2 --}}
        <div class="bg-surface border border-outline-variant/30 p-6 rounded-lg shadow-card relative">
            <div class="flex justify-between items-start mb-4">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-secondary">location_on</span>
                    <span class="text-caption uppercase tracking-widest text-on-surface-variant font-bold">Bureau</span>
                </div>
                <div class="flex gap-2">
                    <button class="text-on-surface-variant hover:text-primary transition-colors"><span class="material-symbols-outlined text-[18px]">edit</span></button>
                    <button class="text-on-surface-variant hover:text-error transition-colors"><span class="material-symbols-outlined text-[18px]">delete</span></button>
                </div>
            </div>
            <p class="font-sans text-body text-on-surface-variant leading-relaxed">
                Emmanuel Henry<br>
                Plateau, Immeuble Horizon, 4ème étage<br>
                Abidjan, Côte d'Ivoire
            </p>
        </div>
    </div>
</div>
@endsection
