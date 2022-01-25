<?php

namespace Shop;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\Concerns\HasAuthenticatedUser;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;
    use HasAuthenticatedUser;


   /* /**
     * @dataProvider ProductFilterDataProvider
     * @param array $filters
     * @param array $productDataCreated
     * @test
     */
    public function test_it_can_filter_products(): void
    {
        $filters = [
            'product_name' => 'Product filter',
            'category' => 1,
            'range_price' => [100, 5000],
        ];

        $product = [
            'product_name' => 'Product filter',
            'list_price' => rand('100', '500'),
            'price' => rand('10', '20'),
            'category_id' => 1,
            'enabled_at' => now(),
            'created_at' => '12-11-2021',
            'url_product_img' => 'default_picture.png',
        ];

        Product::factory()->create($product);

        $response = $this->actingAs($this->defaultUser())
            ->get('/api/products?' . http_build_query($filters));

        $reponseData=json_decode($response->getContent(),true);

        $this->assertCount(13, $reponseData);
       // $this->assertEquals($product['product_name'], $reponseData['data'][0]['product_name']);
       // $this->assertEquals($productData['email'], $users->first()->email);
    }


    public function ProductFilterDataProvider(): array
    {
        return [
            'filter shop online' => [
                'filters' => [
                    'findByCategory' => 1,
                    'findByPriceRange' => [100, 5000],
                    'findByNameOfProduct' => 'Product filter',
                ],
                'product_data_created' => [
                    'product_name' => 'Product filter',
                    'list_price' => rand('100', '500'),
                    'price' => rand('10', '20'),
                    'category_id' => 1,
                    'enabled_at' => now(),
                    'created_at' => '12-11-2021',
                    'url_product_img' => 'default_picture.png',
                ],
            ],
        ];
    }
}
