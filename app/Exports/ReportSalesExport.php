<?php

namespace App\Exports;

use App\Models\SalesReport;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ReportSalesExport implements  WithCustomCsvSettings, FromQuery, WithMapping
{
    private array $dateRange;

    public function __construct(array $dateRange)
    {
        $this->dateRange=$dateRange;
    }

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ','
        ];
    }

    public function map($sales): array
    {
        return [
            $sales->id,
            $sales->total,
            $sales->qty,
            $sales->status,
            $sales->crated_formatted
        ];
    }

    public function query(): \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder
    {
        return SalesReport::filter(['dates'=>$this->dateRange]);
    }
}
