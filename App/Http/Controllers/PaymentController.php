<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use App\FactoryMethod\FactoryPaymentGateway;
use App\FactoryMethod\PlaceToPayFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;


class PaymentController extends Controller
{
    public function createRequest(PurchaseOrder $purchaseOrder): JsonResponse
    {
    $apiRequest = 'PlaceToPayFactory';
    $getApiResponse= createRequestApiWallet(new PlaceToPayFactory($purchaseOrder));

    return response()->json($getApiResponse->getData()->processUrl);
    }

    public function getRequestPaymentWallet(PurchaseOrder $purchaseOrder): JsonResponse
    {
        $apiRequest = 'PlaceToPayFactory';
        $getApiResponse= createGetRequestApiWallet(new PlaceToPayFactory($purchaseOrder));

        return response()->json($getApiResponse->getData()->processUrl);
    }

    public function paymentResponse($id): View
    {
        //llamar metodo asincrono -----------
        $product = PurchaseOrder::where('id', '=', $id)->firstOrFail();

        return view('payment.index')->with('purchaseOrder', $product);
    }

}

    function createRequestApiWallet(FactoryPaymentGateway $creator): JsonResponse
    {
        return $creator->connectApi();
    }

    function createGetRequestApiWallet(FactoryPaymentGateway $creator): JsonResponse
    {
        return $creator->walletPayment();
    }
