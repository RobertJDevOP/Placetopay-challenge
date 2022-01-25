<?php

namespace App\Providers;

use App\Factory\FactoryApiWalletGateway;
use App\Factory\WebCheckoutPlaceToPay\PlaceToPayFactory;
use Illuminate\Support\ServiceProvider;

class PaymentGatewayProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->app->bind(FactoryApiWalletGateway::class,function ($app,$params){
            return match ($params[3]){
                'placetopay' => new PlaceToPayFactory($params[0],$params[1],$params[2]),
                default => throw new Exception('No suitable payment gateway was found'),
            };
        });
    }
}


