<?php

namespace App\FactoryMethod;

use Illuminate\Http\JsonResponse;

abstract class FactoryPaymentGateway
{
    abstract public function getFactoryPaymentGateway(): IGatewayApiWallet;

    abstract public function paymentFactoryGateway(): IPaymentGateway;

    public function connectApi(): JsonResponse
    {
        $network = $this->getFactoryPaymentGateway();
        $request=$network->makeRequest();

        if($request->successful()){
           $response=$network->getBodyResponse($request);
        }

        return $response;
    }

    public function walletPayment(): JsonResponse
    {
        $network = $this->paymentFactoryGateway();
        $request=$network->makePayment();

        if($request->successful()){
            $response=$network->getBodyResponse($request);
        }

        return $response;
    }
}

