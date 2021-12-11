<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories =  \App\Models\ProductCategory::pluck('id');

        foreach ($categories as $categoryId) {
            \App\Models\Product::factory(rand(1,10000))->create([
                'category_id' => $categoryId,
            ]);
        }
    }
}
