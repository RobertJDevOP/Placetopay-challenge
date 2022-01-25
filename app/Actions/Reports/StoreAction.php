<?php

namespace App\Actions\Reports;

use App\Models\Reports;

class StoreAction
{
    public static function execute(string $nameReport): int
    {
        $report = new Reports();
        $report->status ='PROCESSING';
        $report->name = $nameReport;
        $report->save();

        return $report->id_report;
    }
}
