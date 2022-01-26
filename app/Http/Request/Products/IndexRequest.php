<?php

namespace App\Http\Request\Products;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class IndexRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'code' => ['bail','required', 'string', 'max:10',Rule::unique(Product::class)],
            'product_name' => ['bail','required', 'string', 'max:255'],
            'category_id'=> ['bail','required', 'numeric','exists:products_categories,id'],
            'list_price'=> ['bail','required', 'numeric','min:0|max:100000000'],
            'price'=> ['bail','required', 'numeric','min:0|max:100000000'],
            'url_product_img'=> ['bail','image','mimes:jpg,bmp,png','max:2048'],
        ];
    }
}
