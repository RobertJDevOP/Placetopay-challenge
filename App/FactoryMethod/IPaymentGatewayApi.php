<?php

namespace App\FactoryMethod;

interface IPaymentGatewayApi
{
    public function makeRequest(): object;

    public function getBodyResponse(object $request): void;
}
