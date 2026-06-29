<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $images = [
            'sac-a-main-classique-bleu-ciel-petit.jpg',
            'sac-a-main-premium-marron-caramel-petit.jpg',
            'sac-a-main-premium-bleu-bic-petit.jpg',
            'Sac-Blac-Joyaux-Bleu-Rose-Intense.jpg',
            'Sac-Blac-Joyaux-Bleu-Roi-3.jpg',
            'Sac-Blac-Joyaux-Vert.jpg',
            'Sac-Blac-Joyaux-Rouge-Bordeaux.jpg',
            'Sac-a-main-Blac-Joyaux-Croco-rose-fuchsia.jpg',
            'Sac-a-main-Blac-Joyaux-nouvelle-version-peau-serpent-petit.jpg',
            'Sac-Blac-Joyaux-croco-bleu-ciel.jpg',
            'Sac-Blac-Joyaux-rouge-bordeaux-intense.jpg',
            'Sac-a-main-Blac-Joyaux-nouvelle-version-bleu-bic.jpg',
            'Sac-a-main-Blac-Joyaux-nouvelle-version-jaune-moutarde-petit.jpg',
            'Sac-a-main-Blac-Joyaux-Gris-Brilliant.jpg',
            'Sac-a-main-Blac-Joyaux-Croco-Noir-Vernis.jpg',
            'Sac-a-main-Blac-Joyaux-Croco-Rouge-Vernis.jpg',
            'sacs-blac-joyaux.jpg',
            'sacs-blac-joyaux-4.jpg',
            'presentation-sac-blac-joyaux-croco-violet-.jpg',
            'Collection-Sacs-Blac-Joyaux-Do-Dominique-Ouattara.jpg',
            'Sac-Blac-Joyaux-DO-Croco-Lezard.jpg',
            'Sac-Blac-Joyaux-DO-Cuir-Marron.jpg',
            'Sac-Blac-Joyaux-Croco-Jaune.jpg',
        ];

        $products = \App\Models\Product::all();

        foreach ($products as $index => $product) {
            $image = $images[$index % count($images)];
            $product->update(['image' => $image]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
