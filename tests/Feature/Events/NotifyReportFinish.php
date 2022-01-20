<?php

namespace Events;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\Concerns\HasAuthenticatedUser;
use Tests\TestCase;

class NotifyReportFinish extends TestCase
{
    use RefreshDatabase;
    use HasAuthenticatedUser;

    /** @test */
    public function notify_report_event_is_dispatched_upon_call(): void
    {
        Event::fake();

        $this->actingAs($this->defaultUser())->post('/generateReport',['typeReport'=> 'salesReport', 'dates'=>['1/19/2022' , '1/19/2022']]);

        Event::assertDispatched(\App\Events\NotifyReportFinish::class);
    }
}
