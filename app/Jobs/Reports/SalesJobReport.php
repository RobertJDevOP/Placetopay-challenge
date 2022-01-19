<?php

namespace App\Jobs\Reports;

use App\Exports\ReportSalesExport;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;

class SalesJobReport implements ShouldQueue
{
    use Batchable , Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private array $dateRange;
    private mixed $fileName;

    public function __construct(array $dateRange,mixed $fileName)
    {
        $this->dateRange=$dateRange;
        $this->fileName=$fileName;
    }

    public function handle(): void
    {
        Excel::store(new ReportSalesExport($this->dateRange), $this->fileName, 'shopreports', \Maatwebsite\Excel\Excel::CSV);
    }
}
