<?php

namespace Jobs;

use App\Events\NotifyReportFinish;
use App\Jobs\Reports\SalesJobReport;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Queue;
use Tests\Concerns\HasAuthenticatedUser;
use Tests\TestCase;

class SalesJobTest extends  TestCase
{
    use RefreshDatabase;
    use HasAuthenticatedUser;

    public function setUp(): void
    {
        parent::setUp();
        $this->fileName = 'Salesreport'.time().'.csv';
    }

    public  function test_it_can_dispatched_jobs_to_bus_queue(): void
    {
        Bus::fake();

        SalesJobReport::dispatch([0=>'1/19/2022',1=>'1/19/2022'],$this->fileName);

        Bus::assertDispatched(SalesJobReport::class);
    }

    /** @test */
    public function generate_report_job_is_pushed_to_queue(): void
    {
        Queue::fake();

        $this->actingAs($this->defaultUser())->post('/generateReport',['typeReport'=> 'salesReport', 'dates'=>['1/19/2022' , '1/19/2022']]);

        Queue::assertPushed(SalesJobReport::class);
    }
}
