<?php

namespace App\ViewModels\PurchaseOrder;

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
        return 'Purchase order history';
    }

    protected function data(): array
    {
        return [
            'products' => $this->collection,
        ];
    }
}
