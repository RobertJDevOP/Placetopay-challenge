<?php

namespace App\FactoryMethod;

use Illuminate\Http\JsonResponse;

interface IGatewayApiWallet
{
    public function makeRequest(): object;

    public function getBodyResponse(object $request): JsonResponse;
}
