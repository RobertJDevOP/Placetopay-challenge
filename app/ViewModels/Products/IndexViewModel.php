<?php

namespace App\ViewModels\Products;

use App\ViewModels\Concerns\HasPaginator;
use App\ViewModels\ViewModel;

class IndexViewModel extends ViewModel
{
    use HasPaginator;


    protected function buttons(): array
    {
        return [];
    }

    protected function title(): string
    {
        return 'Products';
    }

    protected function data(): array
    {
        return [
            'products' => $this->collection,
        ];
    }
}
