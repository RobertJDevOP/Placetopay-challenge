<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use App\FactoryMethod\FactoryPaymentGateway;
use App\FactoryMethod\PlaceToPayFactory;
use App\FactoryMethod\StripeFactory;

use Illuminate\Support\Str;

/*
factory method
 no se sabe de antemano que clase se va a usar en este caso puede ser PSE o placetopay para la pasarela
 y pues la fabrica de objetos me devuelve la clase que necesito con su respectivo contrato */
class PaymentController extends Controller
{
    public function purchaseToPay(PurchaseOrder $purchaseOrder){
     //EJEM
       $apiRequest = 'PlaceToPayFactory';

        createRequestPayment(new PlaceToPayFactory($purchaseOrder));
    //Crear service provider... para identificar que instancia debe retornar la fabrica de objetos...



    }


}

function createRequestPayment(FactoryPaymentGateway $creator): void
{
    $creator->connectApi();
}

