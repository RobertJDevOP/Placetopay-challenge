<?php

namespace App\Imports;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class ProductsImport implements ToModel, WithChunkReading
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
}
