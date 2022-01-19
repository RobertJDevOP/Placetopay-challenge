<?php

namespace App\Jobs;

use App\Exports\ReportSalesExport;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;

class ReporteGenerateProcess implements ShouldQueue
{
    use Batchable , Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private array $salesRecord;
    private mixed $fileName;

    public function __construct(array $salesRecord,mixed $fileName)
    {
        $this->salesRecord=$salesRecord;
        $this->fileName=$fileName;
    }

    public function handle(): void
    {
        Excel::store(new ReportSalesExport(), $this->fileName, 'shopreports', \Maatwebsite\Excel\Excel::CSV);
    }
}
