<?php

namespace App\Reports;

use App\Events\NotifyReportFinish;
use App\Jobs\ReporteGenerateProcess;
use App\Models\Reports;
use Illuminate\Bus\Batch;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Storage;

class Sales implements ReportsContract
{

    private string $nameReport;
    private int $idReport;

    public function __construct(string $nameReport)
    {
        $this->nameReport=$nameReport;
    }

    public function generate(): void
    {
        $report = new Reports();
        $report->batch_name=$this->nameReport;
        $report->status='PROCESSING';
        $report->save();

        $this->idReport=$report->id_report;
         Storage::disk('shopreports')->append('sales.txt','Sales report');

        $sleep=20;
        $batch = Bus::batch([
            new ReporteGenerateProcess($sleep),
        ])->name('reporte1')
        ->then(function (Batch $batch){
          //  Log::info('Termino proceso job queue ',['batch id'=>$batch->id]);

            Reports::where('id_report', $this->idReport)
                ->update(['status' => 'FINISH','path'=>'sales.txt']);
            event(new NotifyReportFinish('FINISH'));

        })->dispatch();
    }
}
