<?php

namespace App\Actions\Reports;

use App\Models\Reports;

class SalesStoreAction
{
    public static function execute(): int
    {
        $report = new Reports();
        $report->status ='PROCESSING';
        $report->name = 'Sales report';
        $report->save();

        return $report->id_report;
    }
}
