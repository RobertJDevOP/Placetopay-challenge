<?php

namespace Api\Products;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DestroyTest extends TestCase
{
    use RefreshDatabase;

     public function test_it_can_destroy_product(): void
     {
         $product = Product::factory()->createOne();

         $response = $this->deleteJson('/api/v1/product/' . $product->getRouteKey());

         $response->assertJson([
             'data' => [
                 'type' => 'products',
                 'id' => (string)$product->getRouteKey(),
                 'message' => 'Product deleted successfully',
             ]
         ]);
     }
}
