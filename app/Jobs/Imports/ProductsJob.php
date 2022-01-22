<?php

namespace App\Jobs\Imports;


use App\Actions\Reports\UpdateAction;
use App\Events\ImportProductsValidateErrors;
use App\Imports\ProductsImport;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class ProductsJob implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private string $fileName;
    private int $importId;

    public function __construct(string $fileName,int $importId)
    {
        $this->importId=$importId;
        $this->fileName = $fileName;
    }

    public function handle(): void
    {
        try {
            Excel::import(new ProductsImport(), $this->fileName,null,\Maatwebsite\Excel\Excel::CSV);
        }catch (\Exception $e){
            $failures = $e->failures();
            UpdateAction::execute(null,$this->importId,null,'FAILED');
            foreach ($failures as $failure) {
                 Log::error($failure->errors());
                 event(new ImportProductsValidateErrors($failure->errors()));
            }
        }
    }
}
