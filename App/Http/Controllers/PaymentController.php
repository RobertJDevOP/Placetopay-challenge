<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use App\FactoryMethod\FactoryPaymentGateway;
use App\FactoryMethod\PlaceToPayFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;


class PaymentController extends Controller
{
    public function purchaseToPay(PurchaseOrder $purchaseOrder)
    {
    $apiRequest = 'PlaceToPayFactory';
    $xd= createRequestPayment(new PlaceToPayFactory($purchaseOrder));

     return redirect::to($xd->getData()->processUrl);
    }

}

    function createRequestPayment(FactoryPaymentGateway $creator): JsonResponse
    {
      $xd=  $creator->connectApi();
      return  $xd;
    }

