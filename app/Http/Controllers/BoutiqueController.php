<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class BoutiqueController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nom', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%')
                  ->orWhere('matiere', 'like', '%' . $search . '%');
            });
        }

        // Filtering by category
        if ($request->filled('categorie')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->categorie);
            });
        }

        // Filtering by "New"
        if ($request->get('nouveautes') === '1') {
            $query->where('is_new', true);
        }

        // Sorting
        $sort = $request->get('tri', 'nouveautes');
        switch ($sort) {
            case 'prix-asc':
                $query->orderBy('prix', 'asc');
                break;
            case 'prix-desc':
                $query->orderBy('prix', 'desc');
                break;
            case 'nouveautes':
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        $products = $query->paginate(12)->withQueryString();

        return view('pages.boutique.index', compact('products'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->with(['category', 'colors', 'images'])->firstOrFail();

        $relatedProducts = Product::where('categorie_id', $product->categorie_id)
            ->where('id', '!=', $product->id)
            ->limit(4)
            ->get();

        return view('pages.boutique.show', compact('product', 'relatedProducts'));
    }

    public function collections()
    {
        $categories = Category::all();

        return view('pages.collections', compact('categories'));
    }
}
