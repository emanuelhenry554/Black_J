<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Str;

class InnovationProductsSeeder extends Seeder
{
    public function run()
    {
        $category = \App\Models\Category::firstOrCreate(
            ['nom' => 'Innovation'],
            ['slug' => 'innovation']
        );

        $products = [
            [
                'id' => 1,
                'categorie_id' => $category->id,
                'nom' => 'Sac Trapèze',
                'slug' => Str::slug('Sac Trapèze'),
                'prix' => 125000,
                'image' => 'ino1.jpeg',
                'description' => 'Le Sac Trapèze est l\'incarnation de l\'équilibre parfait entre structure et fluidité. Conçu avec un cuir pleine fleur rigoureusement sélectionné, sa silhouette architecturale s\'inspire des lignes modernistes tout en conservant la chaleur de l\'artisanat traditionnel.',
                'description_courte' => 'Sac trapèze en cuir, finitions dorées et doublure soignée.',
                'stock' => 10,
                'is_featured' => true,
            ],
            [
                'id' => 2,
                'categorie_id' => $category->id,
                'nom' => 'Sac Valise',
                'slug' => Str::slug('Sac Valise'),
                'prix' => 98000,
                'image' => 'ino2.jpeg',
                'description' => 'Pensée pour la femme active et voyageuse, le Sac Valise allie fonctionnalité et prestige. Sa structure renforcée protège vos essentiels tout en offrant un volume optimisé.',
                'description_courte' => 'Valise compacte, structure renforcée, idéale pour le voyage urbain.',
                'stock' => 10,
                'is_featured' => true,
            ],
            [
                'id' => 3,
                'categorie_id' => $category->id,
                'nom' => 'Sac Signature',
                'slug' => Str::slug('Sac Signature'),
                'prix' => 150000,
                'image' => 'ino3.jpeg',
                'description' => 'Le Sac Signature est le cœur battant de Blac Joyaux. Il raconte l\'histoire d\'une fusion réussie entre l\'héritage culturel ivoirien et les exigences du luxe international.',
                'description_courte' => 'Notre sac signature mêlant tradition et design contemporain.',
                'stock' => 10,
                'is_featured' => true,
            ],
        ];

        foreach ($products as $productData) {
            Product::updateOrCreate(['id' => $productData['id']], $productData);
        }
    }
}
