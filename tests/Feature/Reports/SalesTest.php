<?php

namespace Reports;

use App\Exports\ReportSalesExport;
use Tests\Concerns\HasAuthenticatedUser;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Maatwebsite\Excel\Facades\Excel;
use Tests\TestCase;

class SalesTest extends TestCase
{
    use RefreshDatabase;
    use HasAuthenticatedUser;

    public function setUp(): void
    {
        parent::setUp();
        $this->fileName = 'Salesreport'.time().'.csv';
    }

    public function test_it_can_storage_report_sales(): void
    {
        Excel::fake();
        $this->withoutExceptionHandling();

        $this->actingAs($this->defaultUser())->post('/generateReport',['typeReport'=> 'salesReport', 'dates'=>['1/19/2022' , '1/19/2022']]);

        Excel::assertStored($this->fileName, 'shopreports');
        Excel::assertStored($this->fileName, 'shopreports', function(ReportSalesExport $export) {
            return true;
        });
    }

}
