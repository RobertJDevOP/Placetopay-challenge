<?php

namespace App\Http\Request\Products;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class IndexUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'code' => ['bail','required', 'string', 'max:10',Rule::unique(Product::class)],
            'product_name' => ['required', 'string', 'max:100'],
            'category_id'=> ['required', 'numeric','exists:products_categories,id'],
            'list_price'=> ['required', 'numeric','min:0|max:100000000'],
            'price'=> ['required', 'numeric','min:0|max:100000000'],
            'url_product_img'=> ['nullable','image','mimes:jpg,bmp,png','max:2048'],
        ];
    }
}
