<?php

namespace App\Reports;

use App\Actions\Reports\StoreAction;
use App\Actions\Reports\UpdateAction;
use App\Events\NotifyImportProductFinish;
use App\Jobs\Imports\ProductsJob;
use Illuminate\Bus\Batch;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;
use Throwable;

class ImportProducts implements ReportsContract
{
    private string $file;
    private int $importId;

    public function __construct(string $file)
    {
        $this->file=$file;
        $this->importId = StoreAction::execute('Products import');
    }
    public function generate(): void
    {
        Bus::batch([
            new ProductsJob($this->file,$this->importId),
        ])->name('importProduct')
          ->then(function (Batch $batch){

            UpdateAction::execute($batch->id,$this->importId,null,'FINISH');
            event(new NotifyImportProductFinish('FINISH'));

        })->catch(function (Batch $batch, Throwable $e){

            Log::withContext(['batch-id' => $batch->id, 'error' => $e]);
            UpdateAction::execute($batch->id,$this->importId,null,'FAILED');
            event(new NotifyImportProductFinish('FINISH'));

        })->finally(function (Batch $batch){

        })->dispatch();
    }
}
