<?php

namespace App\Actions\Api\Product;

use App\Models\Product;
use Illuminate\Http\Request;

class UpdateAction
{
    public static function execute(Product $product,Request $request): Product
    {
        $product->product_name = $request->product_name;
        $product->category_id = $request->category_id;
        $product->list_price = $request->list_price;
        $product->price = $request->price;
        $product->save();
        $product->message = 'Product updated successfully';

        return $product;
    }
}
