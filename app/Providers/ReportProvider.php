<?php

namespace App\Providers;

use App\Models\Product;
use App\Reports\ImportProducts;
use App\Reports\Products;
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
                'productReport' => new Products(),
                'importProducts' => new ImportProducts($params['file']),
                default => throw new Exception('Type report not found'),
            };
        });
    }
}
