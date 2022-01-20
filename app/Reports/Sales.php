<?php

namespace App\Reports;

use App\Actions\Reports\StoreAction;
use App\Actions\Reports\UpdateAction;
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
        $this->idReport = StoreAction::execute('Sales report');
    }

    public function generate(): void
    {
        Bus::batch([
            new SalesJobReport($this->dates,$this->fileName),

            ])->name('salesReport')
        ->then(function (Batch $batch) {

            UpdateAction::execute($batch->id,$this->idReport,$this->fileName,'FINISH');

            event(new NotifyReportFinish('FINISH'));

        })->catch(function (Batch $batch, Throwable $e) {

            Log::withContext(['batch-id' => $batch->id, 'error' => $e]);

            UpdateAction::execute($batch->id,$this->idReport,null,'FAILED');

            event(new NotifyReportFinish('FINISH'));

        })->finally(function (Batch $batch) {

        })->dispatch();
    }
}
