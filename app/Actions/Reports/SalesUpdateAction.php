<?php

namespace App\Actions\Reports;

use App\Models\Reports;

class SalesUpdateAction
{
    public static function execute(string $batchId,int $reportId,mixed $path): void
    {
        Reports::where('id_report', $reportId)->update(['status' => 'FINISH',
                                                        'path'=>$path,
                                                        'id_batch_job'=>$batchId]);
    }
}
