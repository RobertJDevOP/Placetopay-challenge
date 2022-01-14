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

        try {
            $request=$API->createRequest();
            $response=$API->getBodyResponse($request);
        } catch(ConnectionException $e){
             $response= response()->json($e,  500);
        }

        return $response;
    }

    public function apiRequestStatus(): JsonResponse
    {
        $API = $this->getRequestInformationGatewayApiWallet();

        try {
            $request=$API->getRequestInformation();
            $response=$API->getBodyResponse($request);
        } catch(ConnectionException $e){
            $response= response()->json($e,  500);
        }

        return $response;
    }
}
