<?php

namespace App\Reports;

use App\Actions\Reports\StoreAction;
use App\Actions\Reports\UpdateAction;
use App\Events\NotifyProductExportFinish;
use App\Jobs\Reports\ProductsJobReport;
use Illuminate\Bus\Batch;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;
use Throwable;

class Products implements ReportsContract
{
    private mixed $fileName;
    private int $idReport;

    public function __construct()
    {
        $this->fileName = 'Productsreport'.time().'.csv';
        $this->idReport = StoreAction::execute('Products report');
    }
    public function generate(): void
    {
        Bus::batch([
            new ProductsJobReport($this->fileName),
        ])->name('ProductReport')
        ->then(function (Batch $batch){

            UpdateAction::execute($batch->id,$this->idReport,$this->fileName,'FINISH');

            event(new NotifyProductExportFinish('FINISH'));

        })->catch(function (Batch $batch, Throwable $e){

            Log::withContext(['batch-id' => $batch->id, 'error' => $e]);

            UpdateAction::execute($batch->id,$this->idReport,null,'FAILED');

            event(new NotifyProductExportFinish('FINISH'));

        })->finally(function (Batch $batch){

        })->dispatch();
    }
}
