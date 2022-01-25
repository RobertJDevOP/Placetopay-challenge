<?php

namespace App\Actions\Api\Product;

use App\Models\Product;

class DeleteAction
{
    public static function execute(Product $product): Product
    {
        $product->delete();

        return $product;
    }
}
