<?php

namespace App\FactoryMethod;

use Illuminate\Http\JsonResponse;

interface IPaymentGatewayApi
{
    public function makeRequest(): object;

    public function getBodyResponse(object $request): JsonResponse;
}
