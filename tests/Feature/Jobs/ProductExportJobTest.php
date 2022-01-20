<?php

namespace Jobs;

use App\Jobs\Reports\ProductsJobReport;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Queue;
use Tests\Concerns\HasAuthenticatedUser;
use Tests\TestCase;

class ProductExportJobTest extends  TestCase
{
    use RefreshDatabase;
    use HasAuthenticatedUser;

    public function setUp(): void
    {
        parent::setUp();
        $this->fileName = 'Productsreport'.time().'.csv';
    }

    public  function test_it_can_dispatched_jobs_to_bus_queue(): void
    {
        Bus::fake();

        ProductsJobReport::dispatch($this->fileName);

        Bus::assertDispatched(ProductsJobReport::class);
    }

    /** @test */
    public function generate_export_product_job_is_pushed_to_queue(): void
    {
        Queue::fake();

        $this->actingAs($this->defaultUser())->post('/api/exportProducts');

        Queue::assertPushed(ProductsJobReport::class);
    }
}
