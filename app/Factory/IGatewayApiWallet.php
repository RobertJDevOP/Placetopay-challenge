<?php

namespace App\Factory;

use Illuminate\Http\JsonResponse;

interface IGatewayApiWallet
{
    public function createRequest(): object;

    public function getBodyResponse(object $request): JsonResponse;

    public function getRequestInformation(): object;

}
