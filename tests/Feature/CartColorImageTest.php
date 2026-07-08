<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductColor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CartColorImageTest extends TestCase
{
    use RefreshDatabase;

    public function test_cart_uses_selected_color_image_when_available(): void
    {
        $category = Category::create([
            'nom' => 'Sacs',
            'slug' => 'sacs',
        ]);

        $product = Product::create([
            'categorie_id' => $category->id,
            'nom' => 'Sac de soirée',
            'slug' => 'sac-de-soiree',
            'prix' => 150000,
            'stock' => 10,
        ]);

        $color = ProductColor::create([
            'product_id' => $product->id,
            'name' => 'Noir',
            'hex' => '#000000',
            'image_path' => 'colors/black-bag.jpg',
            'stock' => 5,
            'is_available' => true,
        ]);

        $response = $this->post(route('cart.add'), [
            'product_id' => $product->id,
            'color_id' => $color->id,
            'quantity' => 1,
        ]);

        $response->assertRedirect(route('cart.index'));

        $cartItems = session('cart');
        $this->assertNotEmpty($cartItems);
        $this->assertSame('colors/black-bag.jpg', $cartItems[$product->id . '-' . $color->id]['image']);
    }
}
