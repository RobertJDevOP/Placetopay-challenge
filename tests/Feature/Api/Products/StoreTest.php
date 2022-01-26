<?php

namespace Api\Products;

use App\Models\ProductCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StoreTest extends  TestCase
{
    use RefreshDatabase;

    public function test_it_can_store_a_product(): void
    {
        $productCategory = ProductCategory::factory()->createOne();
        $data = ['code' => 'ABCD001','category_id' =>$productCategory->getRouteKey(),
                'product_name' => 'Zapatos cool new','price' => 120000,'list_price' => 140000,'url_product_img' => 'default_product_picture.png'];

        $response = $this->postJson('/api/v1/product', $data);

        $response->assertJson([
            'data' => [
                'type' => 'products',
                'id' => (string)$response['data']['id'],
                'attributes' => [
                    'product_name' => $data['product_name'],
                    'list_price' => $data['list_price'],
                    'url_product_img' => 'default_product_picture.png',
                    'created_at' => now()->toDateString(),
                ],
                'relationships' =>  [
                    'name_category' => $productCategory->name_category,
                ],
                'links' => [
                    'self' => route('api.v1.product.show',$response['data']['id'])
                ],
            ]
        ]);

       $this->assertDatabaseHas('products', $data);
    }

}
