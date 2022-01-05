<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use App\FactoryMethod\FactoryPaymentGateway;
use App\FactoryMethod\PlaceToPayFactory;

class PaymentController extends Controller
{
    public function purchaseToPay(PurchaseOrder $purchaseOrder){
    //Crear service provider... para identificar que instancia debe retornar la fabrica de objetos...
    $apiRequest = 'PlaceToPayFactory';
    createRequestPayment(new PlaceToPayFactory($purchaseOrder));
    }

}

    function createRequestPayment(FactoryPaymentGateway $creator): void
    {
        $creator->connectApi();
    }

