<?php

namespace Events;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Http\UploadedFile;
use Tests\Concerns\HasAuthenticatedUser;
use Tests\TestCase;

class NotifyImportProductFinish extends TestCase
{
    use RefreshDatabase;
    use HasAuthenticatedUser;

    /** @test */
    public function notify_import_products_event_is_call_upon_finish_import(): void
    {
        Event::fake();

        $file=UploadedFile::fake()->create('document.csv', 100);
        $this->actingAs($this->defaultUser())->post('/api/importProducts',['file'=>$file]);

        Event::assertDispatched(\App\Events\NotifyImportProductFinish::class);
    }
}


