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
            'featuredProducts' => Product::where('is_featured', true)->limit(3)->get(),
            'collections' => Category::whereNotIn('slug', ['prestige', 'prestige-collection'])->get(),
            'heroProduct' => Product::where('is_featured', true)->first(),
        ]);
    }

    public function about()
    {
        return view('pages.about');
    }

    public function innovation()
    {
        return view('pages.innovation');
    }

    public function contact()
    {
        return view('pages.contact');
    }
}
