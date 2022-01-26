<?php

namespace Api\Products;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateTest extends  TestCase
{
    use refreshDatabase;

    public function test_it_can_update_a_product(): void
    {
        $product = Product::factory()->create();
        $productCategory = ProductCategory::factory()->createOne();
        $data = ['code' => 'ABCD001','category_id' =>$productCategory->getRouteKey(),
            'product_name' => 'Zapatos cool new','price' => 120000,'list_price' => 140000,'url_product_img' => 'default_product_picture.png'];

        $response = $this->putJson('/api/v1/product/' . $product->getRouteKey(), $data);
        $product->refresh();

        $response->assertJson([
            'data' => [
                'type' => 'products',
                'id' => (string)$product->getRouteKey(),
                'attributes' => [
                    'product_name' => $product->product_name,
                    'list_price' => $product->list_price,
                    'url_product_img' =>$product->url_product_img,
                ],
                'relationships' =>  [
                    'name_category' =>  $product->category->name_category,
                ],
                'links' => [
                    'self' => route('api.v1.product.show', $product->getRouteKey())
                ],
            ]
        ]);
    }
}
