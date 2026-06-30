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
        $categoryImages = [
            'sacs-a-main' => 'sacs-blac-joyaux.jpg',
            'elegance'    => 'Sac-a-main-Blac-Joyaux-Gris-Brilliant.jpg',
            'luxe'        => 'Sac-a-main-Blac-Joyaux-Croco-Noir-Vernis.jpg',
        ];

        foreach ($categoryImages as $slug => $image) {
            \App\Models\Category::where('slug', $slug)->update(['image' => $image]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        \App\Models\Category::update(['image' => null]);
    }
};
