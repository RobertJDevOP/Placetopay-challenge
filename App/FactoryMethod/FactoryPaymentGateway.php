<?php

namespace App\FactoryMethod;

use Illuminate\Http\JsonResponse;

abstract class FactoryPaymentGateway
{
    abstract public function getFactoryPaymentGateway(): IPaymentGatewayApi;

    public function connectApi(): JsonResponse
    {
        $network = $this->getFactoryPaymentGateway();
        $request=$network->makeRequest();

        if($request->successful()){
           $response=$network->getBodyResponse($request);
        }

        return $response;
    }
}

