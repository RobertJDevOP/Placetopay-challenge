<?php

namespace Reports;

use App\Exports\ReportProducts;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Maatwebsite\Excel\Facades\Excel;
use Tests\TestCase;
use Tests\Concerns\HasAuthenticatedUser;

class ProductsExportTest extends TestCase
{
    use RefreshDatabase;
    use HasAuthenticatedUser;

    public function setUp(): void
    {
        parent::setUp();
        $this->fileName = 'Productsreport'.time().'.csv';
    }

    public function test_it_can_storage_exports_product_in_csv(): void
    {
        Excel::fake();
        $this->withoutExceptionHandling();

        $this->actingAs($this->defaultUser())->post('/api/exportProducts');


        Excel::assertStored($this->fileName, 'shopreports');
        Excel::assertStored($this->fileName, 'shopreports', function(ReportProducts $export) {
            return true;
        });
    }
}
