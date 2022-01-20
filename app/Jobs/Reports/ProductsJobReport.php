<?php

namespace App\Jobs\Reports;

use App\Exports\ReportProducts;
use App\Exports\ReportSalesExport;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;

class ProductsJobReport implements ShouldQueue
{
    use Batchable , Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private mixed $fileName;

    public function __construct(mixed $fileName)
    {
        $this->fileName=$fileName;
    }

    public function handle(): void
    {
        Excel::store(new ReportProducts(), $this->fileName, 'shopreports', \Maatwebsite\Excel\Excel::CSV);
    }
}
