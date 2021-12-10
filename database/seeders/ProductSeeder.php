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

       // dd($categories);
        //\App\Models\Product::factory(5)->create();
        foreach ($categories as $categoryId) {
            \App\Models\Product::factory(rand(2, 6))->create([
                'category_id' => $categoryId,
            ]);
        }
    }
}
