<?php

namespace Tests\Concerns;

use App\Models\ProductCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait HasValidationProductsImport
{
    use RefreshDatabase;

    public function csvWithDataIsValid(): mixed
    {
        ProductCategory::factory()->create();
        Storage::fake('uploads');
        $row1 = '1,ropa de prueba 1,250000,300000';
        $row2 = '1,ropa de prueba 2,100000,150000';

        $content = implode("\n", [$row1,$row2]);

        return UploadedFile::fake()->createWithContent('test.csv', $content);
    }

    public function csvWithDataIsInvalid(): mixed
    {
        Storage::fake('uploads');
        $row1 = '1,ROPA DE ROBERTOXD,0,0';
        $row2 = 'ERROFILE,123';

        $content = implode("\n", [$row1,$row2]);

        return UploadedFile::fake()->createWithContent('test.csv', $content);
    }

}
