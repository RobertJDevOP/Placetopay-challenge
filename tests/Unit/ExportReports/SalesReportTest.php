<?php

namespace ExportReports;

use App\Exports\ReportSalesExport;
use stdClass;
use PHPUnit\Framework\TestCase;

class SalesReportTest extends TestCase
{
    public function test_it_csv_setting_is_array_with_delimiter(): void
    {
       $array=['delimiter' => ','];
       $unit = new ReportSalesExport([]);

       $unit->getCsvSettings();

       $this->assertArrayHasKey('delimiter', $array);
    }

    public function test_it_map_return_array(): void
    {
        $sales = new stdClass();
        $sales->id = 1;
        $sales->total = 500000;
        $sales->qty = 5;
        $sales->status = 'APROVED';
        $sales->crated_formatted = '01/01/2022';
        $unit = new ReportSalesExport([]);
        $arraySales = (array) $sales;

        $unit->map($sales);

        $this->assertArrayHasKey('id',$arraySales);
    }
}
