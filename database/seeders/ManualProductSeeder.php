<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ManualProductSeeder extends Seeder
{
    public function run(): void
    {
        $categoriesData = [
            [
                'slug' => 'do-dominique',
                'nom' => 'DO - Dominique',
                'image' => 'Collection-Sacs-Blac-Joyaux-Do-Dominique-Ouattara.jpg',
                'description' => "L'expression pure de l'élégance ivoirienne. Des silhouettes fortes et un cuir noble pour une allure souveraine.",
                'products' => [
                    [
                        'nom' => 'Sac à main Collection Do - Cuir marron (avec boucle)',
                        'prix' => 50000,
                        'image' => '1.jpeg',
                        'images' => ['1.jpeg', '1.1.jpeg', '1.2.jpeg', '1.3.jpeg'],
                        'description' => "Découvrez notre nouvelle collection DO – Dominique Ouattara, de sacs Joyaux de Bla, édition 2026. Parfaits pour toutes les occasions de la vie quotidienne, ces sacs allient style et fonctionnalité. Conçus pour les femmes modernes en quête d’accessoires pratiques, ils conjuguent luxe, éthique et durabilité tout en célébrant notre riche culture africaine.\n\nDimensions : 27 cm x 16 cm x 11 cm\nDesign intemporel : Ces sacs ajoutent une touche de sophistication à toutes vos tenues. Idéaux pour le bureau, les sorties en ville ou les rencontres entre amis.\nMatériaux de haute qualité : Fabriqués à partir de cuir sélectionné pour sa qualité supérieure et son accessibilité, nos sacs garantissent à la fois durabilité et confort.\nRangement spacieux : Dotés d’un compartiment principal spacieux, de poches intérieures pour vos petits objets essentiels, ces sacs vous permettent de rester organisée tout au long de la journée.\nDétails raffinés : La finition avec une broche en métal chromé doré, les coutures soignées par les meilleurs artisans de Côte d’Ivoire et la doublure intérieure en gabardine 100 % coton ajoutent une touche authentique et éthique à chaque sac.\nConfort de port : L’anse robuste et la bandoulière amovible en simili cuir offrent polyvalence et confort, que vous portiez le sac à la main, à l’épaule ou en travers du corps pour rehausser votre style.\nPalette de couleurs : Disponibles dans une gamme de couleurs classiques et tendance.",
                    ],
                    [
                        'nom' => 'Sac à main Collection DO cuir marron',
                        'prix' => 50000,
                        'image' => '2.jpeg',
                        'images' => ['2.jpeg', '2.1.jpeg', '2.2.jpeg'],
                        'description' => "Découvrez notre nouvelle collection DO – Dominique Ouattara, de sacs Joyaux de Bla, édition 2026. Parfaits pour toutes les occasions de la vie quotidienne, ces sacs allient style et fonctionnalité. Conçus pour les femmes modernes en quête d’accessoires pratiques, ils conjuguent luxe, éthique et durabilité tout en célébrant notre riche culture africaine.\n\nDimensions : 27 cm x 16 cm x 11 cm\nDesign intemporel : Ces sacs ajoutent une touche de sophistication à toutes vos tenues. Idéaux pour le bureau, les sorties en ville ou les rencontres entre amis.\nMatériaux de haute qualité : Fabriqués à partir de cuir sélectionné pour sa qualité supérieure et son accessibilité, nos sacs garantissent à la fois durabilité et confort.\nRangement spacieux : Dotés d’un compartiment principal spacieux, de poches intérieures pour vos petits objets essentiels, ces sacs vous permettent de rester organisée tout au long de la journée.\nDétails raffinés : La finition avec une broche en métal chromé doré, les coutures soignées par les meilleurs artisans de Côte d’Ivoire et la doublure intérieure en gabardine 100 % coton ajoutent une touche authentique et éthique à chaque sac.\nConfort de port : L’anse robuste et la bandoulière amovible en simili cuir offrent polyvalence et confort, que vous portiez le sac à la main, à l’épaule ou en travers du corps pour rehausser votre style.\nPalette de couleurs : Disponibles dans une gamme de couleurs classiques et tendance.",
                    ],
                    [
                        'nom' => 'Sac a main collection DO crocro lézard',
                        'prix' => 70000,
                        'image' => '3.jpeg',
                        'images' => ['3.jpeg', '3.1.jpeg', '3.2.jpeg'],
                        'description' => "Découvrez notre nouvelle collection DO – Dominique Ouattara, de sacs Joyaux de Bla, édition 2026. Parfaits pour toutes les occasions de la vie quotidienne, ces sacs allient style et fonctionnalité. Conçus pour les femmes modernes en quête d’accessoires pratiques, ils conjuguent luxe, éthique et durabilité tout en célébrant notre riche culture africaine.\n\nDimensions : 27 cm x 16 cm x 11 cm\nDesign intemporel : Ces sacs ajoutent une touche de sophistication à toutes vos tenues. Idéaux pour le bureau, les sorties en ville ou les rencontres entre amis.\nMatériaux de haute qualité : Fabriqués à partir de cuir sélectionné pour sa qualité supérieure et son accessibilité, nos sacs garantissent à la fois durabilité et confort.\nRangement spacieux : Dotés d’un compartiment principal spacieux, de poches intérieures pour vos petits objets essentiels, ces sacs vous permettent de rester organisée tout au long de la journée.",
                    ],
                ],
            ],
            [
                'slug' => 'joyaux-de-bla',
                'nom' => 'Joyaux de Bla',
                'image' => 'presentation-sac-blac-joyaux-croco-violet-.jpg',
                'description' => "L'audace et la couleur au service du luxe. Chaque pièce est un bijou de caractère et de passion.",
                'products' => [
                    [
                        'nom' => 'Sac à main – Nouvelle Version – Croco Bleu Ciel (Petit format)',
                        'prix' => 70000,
                        'image' => '4.jpeg',
                        'images' => ['4.jpeg', '4.1.jpeg'],
                        'matiere' => 'Simili cuir premium à effet croco',
                        'dimensions' => '27 × 16 × 11 cm',
                        'description' => "Le sac Nouvelle Version Croco Bleu Ciel de Blac Joyaux allie élégance, modernité et praticité. Son format compact et sa finition effet croco en font un accessoire raffiné, idéal pour accompagner la femme moderne au quotidien.\n\nCaractéristiques :\n* Dimensions : 27 × 16 × 11 cm\n* Simili cuir premium à effet croco\n* Design trapèze élégant\n* Compartiment principal avec poches intérieures\n* Broche en métal doré et doublure en gabardine 100 % coton\n* Anse robuste et bandoulière amovible\n* Port à la main, à l’épaule ou en bandoulière\n* Disponible en plusieurs coloris",
                    ],
                    [
                        'nom' => 'Sac à main – Nouvelle Version – Doré',
                        'prix' => 50000,
                        'image' => '5.jpeg',
                        'images' => ['5.jpeg', '5.1.jpeg'],
                        'matiere' => 'Simili cuir de haute qualité',
                        'dimensions' => '27 × 16 × 11 cm',
                        'description' => "Le sac Nouvelle Version Doré de Blac Joyaux allie élégance, modernité et praticité. Son design trapèze et sa finition dorée apportent une touche de raffinement, idéale pour accompagner toutes vos tenues, de jour comme de soirée.\n\nCaractéristiques :\n* Dimensions : 27 × 16 × 11 cm\n* Simili cuir de haute qualité\n* Design trapèze élégant\n* Compartiment principal avec poches intérieures\n* Broche en métal doré et doublure en gabardine 100 % coton\n* Anse robuste et bandoulière amovible\n* Port à la main, à l’épaule ou en bandoulière\n* Disponible en plusieurs coloris",
                    ],
                    [
                        'nom' => 'Sac à main – Nouvelle Version – Doré (Variante)',
                        'prix' => 50000,
                        'image' => '6.jpeg',
                        'images' => ['6.jpeg', '6.1.jpeg'],
                        'matiere' => 'Simili cuir de haute qualité',
                        'dimensions' => '27 × 16 × 11 cm',
                        'description' => "Le sac Nouvelle Version Doré de Blac Joyaux allie élégance, modernité et praticité. Son design trapèze et sa finition dorée apportent une touche de raffinement, idéale pour accompagner toutes vos tenues, de jour comme de soirée.\n\nCaractéristiques :\n* Dimensions : 27 × 16 × 11 cm\n* Simili cuir de haute qualité\n* Design trapèze élégant\n* Compartiment principal avec poches intérieures\n* Broche en métal doré et doublure en gabardine 100 % coton\n* Anse robuste et bandoulière amovible\n* Port à la main, à l’épaule ou en bandoulière\n* Disponible en plusieurs coloris",
                    ],
                    [
                        'nom' => 'Sac à main – Nouvelle version – Noir avec Bijoux Doré',
                        'prix' => 50000,
                        'image' => '7.jpeg',
                        'images' => ['7.jpeg', '7.1.jpeg'],
                        'matiere' => 'Simili cuir de haute qualité',
                        'dimensions' => '27 × 16 × 11 cm',
                        'description' => "Le sac Nouvelle version Noir avec Bijoux Doré de Blac Joyaux allie élégance, modernité et praticité. Son design trapèze et sa finition noire rehaussée de bijoux dorés apportent une touche de raffinement, idéale pour accompagner toutes vos tenues, de jour comme de soirée.\n\nCaractéristiques :\n* Dimensions : 27 × 16 × 11 cm\n* Simili cuir de haute qualité\n* Design trapèze élégant\n* Compartiment principal avec poches intérieures\n* Broche en métal doré et doublure en gabardine 100 % coton\n* Anse robuste et bandoulière amovible\n* Port à la main, à l’épaule ou en bandoulière\n* Disponible en plusieurs coloris",
                    ],
                    [
                        'nom' => 'Sac à main – Nouvelle version – Rouge avec Bijoux Doré',
                        'prix' => 50000,
                        'image' => '8.jpeg',
                        'images' => ['8.jpeg', '8.1.jpeg'],
                        'matiere' => 'Simili cuir de haute qualité',
                        'dimensions' => '27 × 16 × 11 cm',
                        'description' => "Le sac Nouvelle version Rouge avec Bijoux Doré de Blac Joyaux allie élégance, modernité et praticité. Son design trapèze et sa finition rouge rehaussée de bijoux dorés apportent une touche de raffinement, idéale pour accompagner toutes vos tenues, de jour comme de soirée.\n\nCaractéristiques :\n* Dimensions : 27 × 16 × 11 cm\n* Simili cuir de haute qualité\n* Design trapèze élégant\n* Compartiment principal avec poches intérieures\n* Broche en métal doré et doublure en gabardine 100 % coton\n* Anse robuste et bandoulière amovible\n* Port à la main, à l’épaule ou en bandoulière\n* Disponible en plusieurs coloris",
                    ],
                    [
                        'nom' => 'Sac à main classique – Rose gold (petit format)',
                        'prix' => 50000,
                        'image' => '9.jpeg',
                        'images' => ['9.jpeg', '9.1.jpeg'],
                        'matiere' => 'Simili cuir de haute qualité',
                        'dimensions' => '27 × 16 × 11 cm',
                        'description' => "Que vous alliez au travail, à un rendez-vous ou que vous fassiez des courses, nos sacs coupe trapèze sont l’accessoire parfait pour ajouter une touche d’élégance à votre quotidien.\n\nCaractéristiques :\n* Dimensions : 27 × 16 × 11 cm\n* Simili cuir de haute qualité\n* Design trapèze élégant\n* Compartiment principal avec poches intérieures\n* Broche en métal doré et doublure en gabardine 100 % coton\n* Anse robuste et bandoulière amovible\n* Port à la main, à l’épaule ou en bandoulière\n* Disponible en plusieurs coloris",
                    ],
                    [
                        'nom' => 'Sac à main – Nouvelle version – Rose saumon (petit format)',
                        'prix' => 40000,
                        'image' => '9.2.jpeg',
                        'images' => ['9.2.jpeg', '9.3.jpeg'],
                        'matiere' => 'Simili cuir de haute qualité',
                        'dimensions' => '27 × 16 × 11 cm',
                        'description' => "Le sac Nouvelle version Rose saumon (petit format) de Blac Joyaux allie élégance, modernité et praticité. Son format compact et son design trapèze apportent une touche de raffinement, idéale pour accompagner la femme moderne au quotidien.\n\nCaractéristiques :\n* Dimensions : 27 × 16 × 11 cm\n* Simili cuir de haute qualité\n* Design trapèze élégant\n* Compartiment principal avec poches intérieures\n* Broche en métal doré et doublure en gabardine 100 % coton\n* Anse robuste et bandoulière amovible\n* Port à la main, à l’épaule ou en bandoulière\n* Disponible en plusieurs coloris",
                    ],
                    [
                        'nom' => 'Sac à main – Nouvelle version – Croco Jaune',
                        'prix' => 70000,
                        'image' => '10.jpeg',
                        'images' => ['10.jpeg', '10.1.jpeg'],
                        'matiere' => 'Simili cuir premium à effet croco',
                        'dimensions' => '27 × 16 × 11 cm',
                        'description' => "Le sac Nouvelle version Croco Jaune de Blac Joyaux allie élégance, modernité et praticité. Son format compact et sa finition effet croco en font un accessoire raffiné, idéal pour accompagner la femme moderne au quotidien.\n\nCaractéristiques :\n* Dimensions : 27 × 16 × 11 cm\n* Simili cuir premium à effet croco\n* Design trapèze élégant\n* Compartiment principal avec poches intérieures\n* Broche en métal doré et doublure en gabardine 100 % coton\n* Anse robuste et bandoulière amovible\n* Port à la main, à l’épaule ou en bandoulière\n* Disponible en plusieurs coloris",
                    ],
                ],
            ],
        ];

        foreach ($categoriesData as $catData) {
            $category = Category::updateOrCreate(['slug' => $catData['slug']], [
                'nom' => $catData['nom'],
                'image' => $catData['image'],
                'description' => $catData['description'],
            ]);

            foreach ($catData['products'] as $pData) {
                $slug = Str::slug($pData['nom']);
                $product = Product::updateOrCreate(
                    ['slug' => $slug],
                    [
                        'nom' => $pData['nom'],
                        'prix' => $pData['prix'],
                        'categorie_id' => $category->id,
                        'matiere' => $pData['matiere'] ?? 'Cuir sélectionné',
                        'dimensions' => $pData['dimensions'] ?? '27 cm x 16 cm x 11 cm',
                        'description' => $pData['description'],
                        'image' => $pData['image'],
                        'is_featured' => true,
                        'nouveau' => true,
                        'stock' => 10,
                    ]
                );

                foreach ($pData['images'] as $index => $path) {
                    ProductImage::updateOrCreate(
                        ['product_id' => $product->id, 'path' => $path],
                        ['is_primary' => ($index === 0)]
                    );
                }
            }
        }
    }
}
