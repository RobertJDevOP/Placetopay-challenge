<?php

namespace App\FactoryMethod;

abstract class FactoryPaymentGateway
{
    abstract public function getFactoryPaymentGateway(): IPaymentGatewayApi;

    public function connectApi(): void
    {
        $network = $this->getFactoryPaymentGateway();
        $request=$network->makeRequest();
        $network->getBodyResponse($request);
    }
}

