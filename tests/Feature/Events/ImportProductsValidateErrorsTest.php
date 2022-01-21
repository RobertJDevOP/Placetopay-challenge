<?php

namespace Events;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Event;
use Tests\Concerns\HasAuthenticatedUser;
use Tests\TestCase;

class ImportProductsValidateErrorsTest extends TestCase
{
    use RefreshDatabase;
    use HasAuthenticatedUser;

    /** @test */
    public function notify_import_products_event_is_dispatched_after_errors(): void
    {
        Event::fake();

        $file = UploadedFile::fake()->create('document.csv', 100);
        $response = $this->actingAs($this->defaultUser())->post('/api/importProducts',['file'=>$file]);


        Event::assertNotDispatched(\App\Events\ImportProductsValidateErrors::class);
    }
}
