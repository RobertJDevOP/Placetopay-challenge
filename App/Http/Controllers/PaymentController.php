<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use App\FactoryMethod\FactoryApiWalletGateway;
use App\FactoryMethod\PlaceToPayFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;


class PaymentController extends Controller
{
    public function createRequest(PurchaseOrder $purchaseOrder): JsonResponse
    {
        $apiRequest = 'PlaceToPayFactory';

        $getApiResponse= createRequestApiWallet(new PlaceToPayFactory($purchaseOrder,null));

        return response()->json($getApiResponse->getData()->processUrl);
    }

    public function getRequestInformation($PurchaseOrderId): View
    {
        $apiRequest = 'PlaceToPayFactory';

        $purchaseOrder = PurchaseOrder::where('id', '=', $PurchaseOrderId)->firstOrFail();
        $getApiResponse= createGetRequestInformationApiWallet(new PlaceToPayFactory(null,$purchaseOrder->requestId));

        return view('payment.index')->with('purchaseOrder', $purchaseOrder);
    }

}

    function createRequestApiWallet(FactoryApiWalletGateway $creator): JsonResponse
    {
        return $creator->apiConnect();
    }

    function createGetRequestInformationApiWallet(FactoryApiWalletGateway $creator): JsonResponse
    {
        return $creator->apiRequestStatus();
    }
