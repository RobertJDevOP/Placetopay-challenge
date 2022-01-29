<?php

namespace App\Actions\Api\Product;

use Illuminate\Http\Request;
use App\Models\Product;

class StoreAction
{
    public static function execute(Request $request): Product
    {
        $product = new Product();
        $product->code = $request->code;
        $product->product_name = $request->product_name;
        $product->category_id = $request->category_id;
        $product->list_price = $request->list_price;
        $product->price = $request->price;
        $product->url_product_img = 'default_product_picture.png';
        $product->save();
        $product->message = 'Product created successfully';

        return $product;
    }
}
