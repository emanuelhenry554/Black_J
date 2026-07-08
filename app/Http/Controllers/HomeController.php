<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('pages.home', [
            'featuredProducts' => Product::where('is_featured', true)->limit(4)->get(),
            'collections' => Category::all(),
            'heroProduct' => Product::where('is_featured', true)->first(),
        ]);
    }

    public function about()
    {
        return view('pages.about');
    }

    public function innovation()
    {
        return view('pages.innovation', [
            'innovationItems' => $this->getInnovationItems(),
        ]);
    }

    public function innovationShow($id)
    {
        $items = $this->getInnovationItems();
        $item = collect($items)->firstWhere('id', (int)$id);

        if (!$item) {
            abort(404);
        }

        return view('pages.innovation.show', [
            'item' => $item
        ]);
    }

    private function getInnovationItems()
    {
        return [
            ['id' => 1, 'title' => 'Sac Trapèze', 'price' => 125000, 'img' => asset('img/ino1.jpeg'), 'desc' => "Sac trapèze en cuir, finitions dorées et doublure soignée.", 'full_desc' => "Le Sac Trapèze est l'incarnation de l'équilibre parfait entre structure et fluidité. Conçu avec un cuir pleine fleur rigoureusement sélectionné, sa silhouette architecturale s'inspire des lignes modernistes tout en conservant la chaleur de l'artisanat traditionnel. Chaque couture est réalisée à la main, garantissant une durabilité exceptionnelle et un détail millimétré."],
            ['id' => 2, 'title' => 'Sac Valise', 'price' => 98000, 'img' => asset('img/ino2.jpeg'), 'desc' => "Valise compacte, structure renforcée, idéale pour le voyage urbain.", 'full_desc' => "Pensée pour la femme active et voyageuse, le Sac Valise allie fonctionnalité et prestige. Sa structure renforcée protège vos essentiels tout en offrant un volume optimisé. L'intérieur est doublé d'un textile noble, et ses finitions en or brossé ajoutent une touche de sophistication discrète mais affirmée."],
            ['id' => 3, 'title' => 'Sac Signature', 'price' => 150000, 'img' => asset('img/ino3.jpeg'), 'desc' => "Notre sac signature mêlant tradition et design contemporain.", 'full_desc' => "Le Sac Signature est le cœur battant de Blac Joyaux. Il raconte l'histoire d'une fusion réussie entre l'héritage culturel ivoirien et les exigences du luxe international. Avec son design audacieux et ses matériaux d'exception, il ne s'agit pas seulement d'un accessoire, mais d'une pièce d'art portable qui traverse les générations."],
        ];
    }


    public function contact()
    {
        return view('pages.contact');
    }

    public function innovationExamples()
    {
        return view('pages.innovation_examples', [
            'products' => Product::latest()->limit(3)->get(),
        ]);
    }
}
