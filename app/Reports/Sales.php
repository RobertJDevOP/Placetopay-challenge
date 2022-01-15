<?php

namespace App\Reports;

use App\Events\NotifyReportFinish;
use App\Jobs\ReporteGenerateProcess;
use App\Models\Reports;
use Illuminate\Bus\Batch;
use Illuminate\Support\Facades\Bus;

class Sales implements ReportsContract
{

    private string $nameReport;

    public function __construct(string $nameReport)
    {
        $this->nameReport=$nameReport;
    }

    public function generate(): void
    {
        $report = new Reports();
        $report->batch_name=$this->nameReport;
        $report->save();

        $sleep=30;
        $batch = Bus::batch([
            new ReporteGenerateProcess($sleep),
        ]) ->name('reporte1')
        ->then(function (Batch $batch){
          //  Log::info('Termino proceso job queue xd',['batch id'=>$batch->id]);
            event(new NotifyReportFinish('Termino de ejecutarse el bat'));
        })->dispatch();
    }
}
