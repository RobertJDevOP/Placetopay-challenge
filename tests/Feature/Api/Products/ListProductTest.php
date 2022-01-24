<?php

namespace Api\Products;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListProductTest extends TestCase
{
    use RefreshDatabase;

    public  function test_it_can_fetch_all_products(): void
    {
        $product = Product::factory()
            ->has(ProductCategory::factory(),'category')
            ->count(2)
            ->create();

        $response = $this->getJson(route('api.v1.products.index'));

        $response->assertJson([
            'data' => [
                [
                    'type' => 'products',
                    'id' => (string)$product[0]->getRouteKey(),
                    'attributes' => [
                        'product_name' => $product[0]->product_name,
                        'list_price' => $product[0]->list_price,
                        'url_product_img' => $product[0]->url_product_img,
                    ],
                    'relationships' =>  [
                        'name_category' => $product[0]->category->name_category,
                    ],
                    'links' => [
                        'self' => route('api.v1.product.show',$product[0])
                    ],
                ],
                [
                    'type' => 'products',
                    'id' => (string)$product[1]->getRouteKey(),
                    'attributes' => [
                        'product_name' => $product[1]->product_name,
                        'list_price' => $product[1]->list_price,
                        'url_product_img' => $product[1]->url_product_img,
                    ],
                    'relationships' => [
                        'name_category' => $product[1]->category->name_category,
                    ],
                    'links' => [
                        'self' => route('api.v1.product.show',$product[1])
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

    public  function test_it_can_fetch_show_product(): void
    {
        $product = Product::factory()
            ->has(ProductCategory::factory(),'category')
            ->create();

        $response = $this->getJson(route('api.v1.product.show' ,$product->getRouteKey()));

        $response->assertJson([
            'data' => [
                    'type' => 'products',
                    'id' => (string)$product->getRouteKey(),
                    'attributes' => [
                        'product_name' => $product->product_name,
                        'list_price' => $product->list_price,
                        'url_product_img' => $product->url_product_img,
                    ],
                    'relationships' =>  [
                        'name_category' => $product->category->name_category,
                    ],
                    'links' => [
                        'self' => route('api.v1.product.show',$product->getRouteKey())
                    ],
            ]
        ]);
    }

    public function test_it_can_store_product(): void
    {


    }

}
