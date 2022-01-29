<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Facades\Cache;
class ProductsImport implements ToModel, WithChunkReading , WithValidation, WithUpserts
{
    use importable;

    public function model(array $row): Model|null
    {
        //Cache::forget('categoryIds'); bug---
        $categoryId=Cache::remember('categoryIds',60*60*24,function () use ($row){
            return ProductCategory::where('name_category', $row[1])->firstOrFail()->id;
        });


        return new Product([
            'code'          => $row[0],
            'category_id'   => $categoryId,
            'product_name'  => $row[2],
            'enabled_at'    => null,
            'list_price'    => $row[3],
            'price'         => $row[4],
            'url_product_img'  => 'productDefault.png',
        ]);
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    public function rules(): array
    {
        return [
            0 => ['required', 'string','min:0','max:10'],
            1 => ['required', 'string','exists:products_categories,name_category'],
            2 => ['required', 'string', 'max:255'],
            3 => ['required', 'numeric','min:0|max:100000000'],
            4 => ['required', 'numeric','min:0|max:100000000'],
        ];
    }

    public function uniqueBy(): string
    {
        return 'code';
    }
}
