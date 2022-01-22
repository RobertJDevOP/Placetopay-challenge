<?php

namespace Events;

use App\Events\ImportProductsValidateErrors;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\Concerns\HasAuthenticatedUser;
use Tests\Concerns\HasValidationProductsImport;
use Tests\TestCase;

class ImportProductsValidateErrorsTest extends TestCase
{
    use RefreshDatabase;
    use HasAuthenticatedUser;
    use HasValidationProductsImport;

    public function test_if_import_products_event_is_dispatched_after_errors(): void
    {
        $file = $this->csvWithDataIsInvalid();
        Event::fake();

        $this->actingAs($this->defaultUser())->post('/api/importProducts',['file'=>$file]);

        Event::assertDispatched(ImportProductsValidateErrors::class);
    }

    public function test_if_event_import_error_not_dispatched_when_file_are_ok(): void
    {
        $file = $this->csvWithDataIsValid();
        Event::fake();

        $this->actingAs($this->defaultUser())->post('/api/importProducts',['file'=>$file]);

        Event::assertNotDispatched(ImportProductsValidateErrors::class);
    }


}
