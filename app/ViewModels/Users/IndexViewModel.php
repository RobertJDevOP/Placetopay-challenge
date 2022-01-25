<?php

namespace App\ViewModels\Users;

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
        return 'Clients';
    }

    protected function data(): array
    {
        return [
            'users' => $this->collection,
        ];
    }
}
