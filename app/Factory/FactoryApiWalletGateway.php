<?php

namespace App\Factory;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Client\ConnectionException;

abstract class FactoryApiWalletGateway
{
    abstract public function createRequestGatewayApiWallet(): IGatewayApiWallet;

    abstract public function getRequestInformationGatewayApiWallet(): IGatewayApiWallet;

    public function apiConnect(): JsonResponse
    {
        $API = $this->createRequestGatewayApiWallet();
        $request=$API->createRequest();

        return $API->getBodyResponse($request);
    }

    public function apiRequestStatus(): JsonResponse
    {
        $API = $this->getRequestInformationGatewayApiWallet();
        $request=$API->getRequestInformation();

        return $API->getBodyResponse($request);
    }
}
