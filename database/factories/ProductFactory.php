<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'product_name' => $this->faker->sentence(5),
            'list_price' => rand('10', '20'),
            'price' => rand('10', '20'),
            'category_id' => ProductCategory::Factory()->create(),
            'enabled_at' => now(),
            'created_at' =>  $this->faker->dateTimeBetween('-2 months', 'now'),
            'url_product_img' =>  'productDefault.png',
            'code' => $this->faker->unique()->text(10),
        ];
    }

    public function enabled(): Factory
    {
        return $this->state(function () {
            return [
                'enabled_at' => $this->faker->dateTime(),
            ];
        });
    }

    public function disabled(): Factory
    {
        return $this->state(function () {
            return [
                'enabled_at' => null,
            ];
        });
    }

}
