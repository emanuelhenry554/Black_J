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
        $bagImages = [
            'sac-a-main-classique-bleu-ciel-petit.jpg',
            'sac-a-main-premium-marron-caramel-petit.jpg',
            'sac-a-main-premium-bleu-bic-petit.jpg',
        ];

        $products = \App\Models\Product::whereHas('category', function($q) {
            $q->where('slug', 'sacs-a-main');
        })->get();

        foreach ($products as $index => $product) {
            if (isset($bagImages[$index])) {
                $product->update(['image' => $bagImages[$index]]);
            }
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
