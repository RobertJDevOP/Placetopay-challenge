<?php

namespace App\Providers;

use App\Reports\ReportsContract;
use App\Reports\Sales;
use Exception;
use Illuminate\Support\ServiceProvider;

class ReportProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->app->bind(ReportsContract::class,function ($app,$params){
            return match ($params['typeReport']){
               'salesReport' => new Sales($params['dates']),
               'productsReport' => 'Hola2',
                default => throw new Exception('Type report not found'),
            };
        });
    }
}
