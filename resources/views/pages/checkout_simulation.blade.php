@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center py-20">
    <div class="w-full max-w-lg mx-auto px-4">

        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold">Simulation de paiement</h2>
            <p class="text-gray-500 mt-2">Commande <strong>{{ $order->numero_commande }}</strong></p>
        </div>

        <div class="bg-white border border-gray-200 rounded-xl p-8 mb-6 text-center shadow-sm">
            <div class="text-6xl mb-4">📱</div>
            <h5 class="text-xl font-semibold mb-3">Confirmez la transaction sur votre mobile</h5>
            <p class="text-gray-500">
                Un message a été envoyé au numéro
                <strong>{{ $order->shipping_telephone }}</strong>.<br>
                Veuillez confirmer le paiement de
                <strong>{{ number_format($order->total, 0, ',', ' ') }} FCFA</strong>
                via {{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}.
            </p>
            <div class="mt-4">
                <span class="bg-yellow-100 text-yellow-800 px-4 py-2 rounded-full text-sm font-medium">
                    En attente de confirmation...
                </span>
            </div>
        </div>

        {{-- Bouton simulation --}}
        <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-6 text-center">
            <p class="text-gray-400 text-sm mb-4">
                <em>Mode prototype — cliquez pour simuler le succès du paiement</em>
            </p>
            <form action="{{ route('checkout.simulerSucces', $order->numero_commande) }}" method="POST">
                @csrf
                <button type="submit"
                    class="bg-yellow-400 hover:bg-yellow-500 text-black font-bold px-8 py-3 rounded-lg transition">
                    ✅ Simuler le succès du paiement
                </button>
            </form>
        </div>

    </div>
</div>
@endsection
