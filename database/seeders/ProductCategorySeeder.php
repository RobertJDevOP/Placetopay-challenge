<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    public function run(): void
    {
        \App\Models\ProductCategory::factory(5)->create();
    }
}
