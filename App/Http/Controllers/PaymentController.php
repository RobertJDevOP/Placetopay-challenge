<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use App\FactoryMethod\FactoryPaymentGateway;
use App\FactoryMethod\PlaceToPayFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Redirect;


class PaymentController extends Controller
{
    public function createRequest(PurchaseOrder $purchaseOrder): JsonResponse
    {
    $apiRequest = 'PlaceToPayFactory';
    $getApiResponse= createRequestApiWallet(new PlaceToPayFactory($purchaseOrder));

    return response()->json($getApiResponse->getData()->processUrl);
    }

}

    function createRequestApiWallet(FactoryPaymentGateway $creator): JsonResponse
    {
        return $creator->connectApi();
    }

