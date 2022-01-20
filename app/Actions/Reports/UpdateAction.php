<?php

namespace App\Actions\Reports;

use App\Models\Reports;

class UpdateAction
{
    public static function execute(string $batchId,int $reportId,mixed $path,string $status): void
    {
        Reports::where('id_report', $reportId)->update(['status' => $status,
                                                        'path'=>$path,
                                                        'id_batch_job'=>$batchId]);
    }
}
