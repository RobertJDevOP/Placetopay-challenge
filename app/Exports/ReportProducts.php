<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ReportProducts implements  WithCustomCsvSettings, FromQuery, WithMapping
{
    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ','
        ];
    }

    public function map($product): array
    {
        return [
            $product->code,
            $product->category->name_category,
            $product->product_name,
            $product->list_price,
            $product->price,
            $product->crated_formatted
        ];
    }

    public function query()
    {
        return Product::query()->with('category');
    }
}
