<?php

namespace Api\Products;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListProductTest extends TestCase
{
    use RefreshDatabase;

    public  function test_it_can_fetch_all_products()
    {
        $product = Product::factory()->count(2)->create();

        $response = $this->getJson(route('api.v1.products.index'));

        dd($response);

        $response->assertJson([
            'data' => [
                [
                    'type' => 'products',
                    'id' => (string)$product[0]->getRouteKey(),
                    'attributes' => [
                        'product_name' => $product[0]->product_name
                    ],
                    'links' => [
                        'self' => route('api.v1.products.index',$product[0])
                    ],
                ],
                [
                    'type' => 'products',
                    'id' => (string)$product[1]->getRouteKey(),
                    'attributes' => [
                        'product_name' => $product[1]->product_name
                    ],
                    'links' => [
                        'self' => route('api.v1.products.index',$product[1])
                    ],
                ]
            ],
            'links' => [
                'self' => route('api.v1.products.index')
            ],
            'meta' => [
                'products_count' => 2
            ]
        ]);
    }

}
