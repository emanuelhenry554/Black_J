<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductColor;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->get();
        return view('pages.admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('pages.admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'slug' => 'required|string|unique:products,slug',
            'prix' => 'required|integer',
            'categorie_id' => 'required|exists:categories,id',
        ]);

        $product = Product::create([
            'nom' => $request->nom,
            'slug' => $request->slug,
            'prix' => $request->prix,
            'categorie_id' => $request->categorie_id,
            'matiere' => $request->matiere,
            'description' => $request->description,
            'description_courte' => $request->description_courte,
            'image' => $request->image,
            'edition_limitee' => $request->has('edition_limitee'),
            'nouveau' => $request->has('nouveau'),
            'is_featured' => $request->has('is_featured'),
            'is_new' => $request->has('is_new'),
            'stock' => $request->stock ?? 0,
            'dimensions' => $request->dimensions,
            'caracteristiques' => $request->caracteristiques,
        ]);

        // Handle Multiple Images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $file) {
                $path = $file->store('products', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'path' => $path,
                    'is_primary' => ($index === 0),
                ]);

                if ($index === 0) {
                    $product->update(['image' => $path]);
                }
            }
        }

        // Handle Colors
        if ($request->has('colors')) {
            foreach ($request->colors as $color) {
                ProductColor::create([
                    'product_id' => $product->id,
                    'name' => $color['name'],
                    'hex' => $color['hex'],
                ]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Produit créé avec succès.');
    }

    public function edit($id)
    {
        $product = Product::with(['category', 'colors', 'images'])->findOrFail($id);
        $categories = Category::all();
        return view('pages.admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'nom' => 'required|string|max:255',
            'slug' => 'required|string|unique:products,slug,' . $id,
            'prix' => 'required|integer',
            'categorie_id' => 'required|exists:categories,id',
        ]);

        $product->update([
            'nom' => $request->nom,
            'slug' => $request->slug,
            'prix' => $request->prix,
            'categorie_id' => $request->categorie_id,
            'matiere' => $request->matiere,
            'description' => $request->description,
            'description_courte' => $request->description_courte,
            'image' => $request->image,
            'edition_limitee' => $request->has('edition_limitee'),
            'nouveau' => $request->has('nouveau'),
            'is_featured' => $request->has('is_featured'),
            'is_new' => $request->has('is_new'),
            'stock' => $request->stock ?? 0,
            'dimensions' => $request->dimensions,
            'caracteristiques' => $request->caracteristiques,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Produit mis à jour.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Produit supprimé.');
    }
}
