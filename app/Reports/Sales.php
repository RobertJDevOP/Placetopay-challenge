<?php

namespace App\Reports;

use App\Actions\Reports\SalesStoreAction;
use App\Actions\Reports\SalesUpdateAction;
use App\Events\NotifyReportFinish;
use App\Jobs\Reports\SalesJobReport;
use Illuminate\Bus\Batch;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;
use Throwable;

class Sales implements ReportsContract
{
    private array $dates;
    private int $idReport;
    private mixed $fileName;

    public function __construct(array $dates)
    {
        $this->dates = $dates;
        $this->fileName = 'Salesreport'.time().'.csv';
        $this->idReport = SalesStoreAction::execute();
    }

    public function generate(): void
    {
        Bus::batch([
            new SalesJobReport($this->dates,$this->fileName),

            ])->name('salesReport')
        ->then(function (Batch $batch) {

            SalesUpdateAction::execute($batch->id,$this->idReport,$this->fileName,'FINISH');

            event(new NotifyReportFinish('FINISH'));

        })->catch(function (Batch $batch, Throwable $e) {

            Log::withContext(['batch-id' => $batch->id, 'error' => $e]);

            SalesUpdateAction::execute($batch->id,$this->idReport,null,'FAILED');

            event(new NotifyReportFinish('FINISH'));

        })->finally(function (Batch $batch) {

        })->dispatch();
    }
}
