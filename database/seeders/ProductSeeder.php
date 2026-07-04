<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['nom' => 'Sacs à main', 'slug' => 'sacs-a-main'],
            ['nom' => 'Élégance', 'slug' => 'elegance'],
            ['nom' => 'Luxe', 'slug' => 'luxe'],
        ];

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

        $imageIndex = 0;

        foreach ($categories as $catData) {
            // Map category fields to actual DB columns (nom vs name)
            $catPayload = [];
            if (\Illuminate\Support\Facades\Schema::hasColumn('categories', 'nom')) {
                $catPayload['nom'] = $catData['nom'];
            } else {
                $catPayload['name'] = $catData['nom'];
            }
            $catPayload['slug'] = $catData['slug'];

            $category = Category::updateOrCreate(['slug' => $catPayload['slug']], $catPayload);

            // Determine product foreign key name (categorie_id vs category_id)
            $categoryKey = \Illuminate\Support\Facades\Schema::hasColumn('products', 'categorie_id') ? 'categorie_id' : 'category_id';

            // Create 3 products for each category
            for ($i = 1; $i <= 3; $i++) {
                $nom = "Produit {$catData['nom']} $i";

                $image = $images[$imageIndex % count($images)];
                $imageIndex++;

                $productPayload = [];
                $productPayload[$categoryKey] = $category->id;

                // Map product name field (nom vs name)
                if (\Illuminate\Support\Facades\Schema::hasColumn('products', 'nom')) {
                    $productPayload['nom'] = $nom;
                } else {
                    $productPayload['name'] = $nom;
                }

                $productPayload['slug'] = Str::slug($nom) . '-' . $i;
                // prix exists in this schema
                $productPayload['prix'] = rand(50000, 500000);
                $productPayload['matiere'] = 'Cuir véritable';
                $productPayload['description'] = 'Une description détaillée pour le produit ' . $nom;
                if (\Illuminate\Support\Facades\Schema::hasColumn('products', 'description_courte')) {
                    $productPayload['description_courte'] = 'Une courte description pour ' . $nom;
                }
                $productPayload['image'] = $image;

                // Optional fields if present
                if (\Illuminate\Support\Facades\Schema::hasColumn('products', 'edition_limitee')) {
                    $productPayload['edition_limitee'] = (bool)rand(0, 1);
                }
                if (\Illuminate\Support\Facades\Schema::hasColumn('products', 'nouveau')) {
                    $productPayload['nouveau'] = (bool)rand(0, 1);
                }
                if (\Illuminate\Support\Facades\Schema::hasColumn('products', 'stock')) {
                    $productPayload['stock'] = rand(1, 10);
                }
                if (\Illuminate\Support\Facades\Schema::hasColumn('products', 'dimensions')) {
                    $productPayload['dimensions'] = '30cm x 20cm x 10cm';
                }
                if (\Illuminate\Support\Facades\Schema::hasColumn('products', 'caracteristiques')) {
                    $productPayload['caracteristiques'] = 'Finition main, couture renforcée';
                }

                Product::updateOrCreate(['slug' => $productPayload['slug']], $productPayload);
            }
        }
    }
}
