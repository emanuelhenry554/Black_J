<?php

namespace Tests\Feature;

use Tests\TestCase;

class CartImageTest extends TestCase
{
    public function test_cart_page_uses_image_url_when_available(): void
    {
        $cart = [
            '1-0' => [
                'id' => '1-0',
                'product_id' => 1,
                'slug' => 'sac-test',
                'nom' => 'Sac Test',
                'prix' => 150000,
                'quantite' => 1,
                'image' => 'products/test.jpg',
                'image_url' => 'https://example.com/storage/products/test.jpg',
                'couleur' => null,
                'color_id' => null,
            ],
        ];

        $response = $this->withSession(['cart' => $cart])->get(route('cart.index'));

        $response->assertOk();
        $response->assertSee('https://example.com/storage/products/test.jpg', false);
    }
}
