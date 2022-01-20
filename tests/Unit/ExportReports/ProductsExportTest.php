<?php

namespace ExportReports;

use App\Exports\ReportProducts;
use PHPUnit\Framework\TestCase;
use stdClass;

class ProductsExportTest extends TestCase
{
    public function test_it_csv_setting_is_array_with_delimiter(): void
    {
        $array=['delimiter' => ','];
        $unit = new ReportProducts();

        $unit->getCsvSettings();

        $this->assertArrayHasKey('delimiter', $array);
    }

    public function test_it_map_return_array(): void
    {
        $product = new stdClass();
        $product->id = 1;
        $product->product_name = 'Gorra Cool';
        $product->list_price = 123456;
        $product->price= 150000;
        $product->category =new stdClass();
        $product->category->name_category= 'Accesorios';
        $product->crated_formatted = '01/01/2022';

        $unit = new ReportProducts();
        $unit->map($product);
        $arrayProduct = (array) $product;


        $this->assertArrayHasKey('id',$arrayProduct);
    }
}
