<?php

namespace Events;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\Concerns\HasAuthenticatedUser;
use Tests\TestCase;

class NotifyExportProductFinishTest extends TestCase
{
    use RefreshDatabase;
    use HasAuthenticatedUser;

    /** @test */
    public function notify_export_finish_event_is_dispatched_upon_call(): void
    {
        Event::fake();

        $this->actingAs($this->defaultUser())->post('/api/exportProducts');

        Event::assertDispatched(\App\Events\NotifyProductExportFinish::class);
    }
}
