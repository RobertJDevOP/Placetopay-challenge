<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use App\Factory\FactoryApiWalletGateway;
use App\Factory\PlaceToPayFactory;
use App\Models\PurchasePaymentStatus;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;


class PaymentController extends Controller
{
    public function createRequest(PurchaseOrder $purchaseOrder): JsonResponse
    {
        $apiRequest = 'PlaceToPayFactory';
        $getApiResponse= createRequestApiWallet(new PlaceToPayFactory($purchaseOrder,null,null));

        return response()->json($getApiResponse->getData()->processUrl);
    }

    public function retryPayment(Request $request): JsonResponse
    {
        $apiRequest = 'PlaceToPayFactory';

        $purchaseOrderId=$request->input('params')['purchaseOrderId'];
        $user = PurchaseOrder::find($purchaseOrderId);
        $getApiResponse= createRequestApiWallet(new PlaceToPayFactory($user,null,null));

        return response()->json($getApiResponse->getData()->processUrl);
    }

    public function getRequestInformation(int $PurchaseOrderId): View
    {
        $apiRequest = 'PlaceToPayFactory';
        $PurchasePaymentStatus=PurchasePaymentStatus::select('requestId')->where('id_purchase_order', $PurchaseOrderId)
                                                                        ->latest('id_purchase_payment')->first();

        createGetRequestInformationApiWallet(new PlaceToPayFactory(null,$PurchasePaymentStatus->requestId,$PurchaseOrderId));

        $purchaseOrder=PurchasePaymentStatus::select('status','id_purchase_order')->where('id_purchase_order', $PurchaseOrderId)
                                                                                  ->latest('id_purchase_payment')->first();;

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
