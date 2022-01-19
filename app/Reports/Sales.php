<?php

namespace App\Reports;

use App\Actions\Reports\SalesStoreAction;
use App\Actions\Reports\SalesUpdateAction;
use App\Events\NotifyReportFinish;
use App\Jobs\ReporteGenerateProcess;
use App\Models\SalesReport;
use Illuminate\Bus\Batch;
use Illuminate\Support\Facades\Bus;

class Sales implements ReportsContract
{
    private array $dates;
    private int $idReport;
    private mixed $fileName;

    public function __construct(array $dates)
    {
        $this->dates=$dates;
        $this->fileName = 'Salesreport'.time().'.csv';
        $this->idReport = SalesStoreAction::execute();
    }

    public function generate(): void
    {
        $salesRecords = SalesReport::filter(['dates'=>$this->dates])->get();

        $batch = Bus::batch([
            new ReporteGenerateProcess($salesRecords->toArray(),$this->fileName),
        ])->name('salesReport')
        ->then(function (Batch $batch){
              SalesUpdateAction::execute($batch->id,$this->idReport,$this->fileName);
              event(new NotifyReportFinish('FINISH'));
        })->dispatch();
    }
}
