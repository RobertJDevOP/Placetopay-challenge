<?php

namespace App\Imports;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithValidation;

class ProductsImport implements ToModel, WithChunkReading , WithValidation, WithUpserts
{
    public function model(array $row): Model|null
    {
        return new Product([
            'category_id'   => $row[0],
            'product_name'  => $row[1],
            'enabled_at'    => null,
            'list_price'    => $row[2],
            'price'         => $row[3],
            'url_product_img'  => 'default_picture.jpg',
        ]);
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    public function rules(): array
    {
        return [
            0 =>  ['required', 'numeric','exists:products_categories,id'],
            1 => ['required', 'string', 'max:255'],
            2 => ['required', 'numeric','min:0|max:100000000'],
            3 => ['required', 'numeric','min:0|max:100000000'],
        ];
    }

    public function customValidationMessages(): array
    {
        return [
            0 => 'Custom message for :attribute???.',
        ];
    }

    public function uniqueBy()
    {
        return 'reference';
    }
}
