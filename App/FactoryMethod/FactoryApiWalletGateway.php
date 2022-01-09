<?php

namespace App\FactoryMethod;

use Illuminate\Http\JsonResponse;

abstract class FactoryApiWalletGateway
{
    abstract public function createRequestGatewayApiWallet(): IGatewayApiWallet;

    abstract public function getRequestInformationGatewayApiWallet(): IGatewayApiWallet;

    public function apiConnect(): JsonResponse
    {
        $API = $this->createRequestGatewayApiWallet();
        $request=$API->createRequest();

        /*if($request->successful()){
           $response=$API->getBodyResponse($request);
        }*/

          $response=$API->getBodyResponse($request);


        return $response;
    }

    public function apiRequestStatus(): JsonResponse
    {
        $API = $this->getRequestInformationGatewayApiWallet();
        $request=$API->getRequestInformation();

       /* if($request->successful()){
            $response=$API->getBodyResponse($request);
        }*/
        $response=$API->getBodyResponse($request);

        return $response;
    }
}

