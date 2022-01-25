<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use App\Factory\FactoryApiWalletGateway;
use App\Models\PurchasePaymentStatus;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;


class PaymentController extends Controller
{
    public function createRequest(PurchaseOrder $purchaseOrder,string $wallet): JsonResponse
    {//Funcionara la sustitucion de liskow?
        $paymentGateway = app()->make(FactoryApiWalletGateway::class,[$purchaseOrder,null,null,$wallet]);

        $response = $paymentGateway->apiConnect();

        return response()->json($response->getData()->processUrl);
    }

    public function retryPayment(Request $request): JsonResponse
    {
        $purchaseOrder = PurchaseOrder::find($request->input('params')['purchaseOrderId']);

        $paymentGateway = app()->make(FactoryApiWalletGateway::class,[$purchaseOrder,null,null,'placetopay']);

        $response = $paymentGateway->apiConnect();

        return response()->json($response->getData()->processUrl);
    }

    public function getRequestInformation(int $PurchaseOrderId): View
    {
        $PurchasePaymentStatus=PurchasePaymentStatus::select('requestId')->where('id_purchase_order', $PurchaseOrderId)
                                                                         ->latest('id_purchase_payment')->first();

        $paymentGateway = app()->make(FactoryApiWalletGateway::class,[null,$PurchasePaymentStatus->requestId,$PurchaseOrderId,'placetopay']);

        $paymentGateway->apiRequestStatus();

        $purchaseOrder=PurchasePaymentStatus::select('status','id_purchase_order')->where('id_purchase_order', $PurchaseOrderId)
                                                                                  ->latest('id_purchase_payment')->first();;

        return view('payment.index')->with('purchaseOrder', $purchaseOrder);
    }

}


