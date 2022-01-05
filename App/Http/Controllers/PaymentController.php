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



    /*    foreach ($purchaseOrder->detailsOrder as  $key){
            foreach($key->products as $key2){
                $detailsOrder [] =['name'=>$key2['product_name'],'qty'=>$key['qty'],'price'=>$key['price'],'category'=>'physical'];
            }
        }

        $apiKey='024h1IlD';
        $nonce=Str::random();
        $seed=date("c");
        $result=$nonce.$seed.$apiKey;
        $tranKey = base64_encode(sha1($result, true));
        $endpoint='https://checkout-co.placetopay.dev/api/session';


        $ad= new ApiAdapter( new ApiPlaceToPay($endpoint,
                [
                'locale' => 'es_CO',
                'auth' => [
                    'login' => '6dd490faf9cb87a9862245da41170ff2',
                    'tranKey' => $tranKey,
                    "nonce" => base64_encode($nonce),
                    "seed" => $seed,
                ],
                'buyer' => [
                    'document' => $purchaseOrder->user->number_document,
                    'documentType' => $purchaseOrder->user->document_type,
                    'name' => $purchaseOrder->user->name,
                    'surname' => $purchaseOrder->user->surnames,
                    'company' => null,
                    'email' => $purchaseOrder->user->email,
                    'mobile' => $purchaseOrder->user->cell_phone,
                    'address' => [
                        'street'=>  $purchaseOrder->user->user_street,
                        'city'=>  'FLORIDABLANCA',
                        'state'=> 'SANTANDER',
                        'postalCode'=> '681001',
                        'country'=> 'COLOMBIA',
                    ]
                ],
                'payment' => [
                    'reference' => $purchaseOrder->id,
                    'description' => 'PAGO COMPRA SHOP ONLINE',
                    'amount' => [
                        'currency' => 'COP',
                        'total' => $purchaseOrder->total,
                    ],
                    'items'  =>[
                        'item' => $detailsOrder
                    ]
                ],
                'expiration' => date('c', strtotime('+1 hour')),
                'returnUrl' => 'https://dnetix.co/p2p/client',
                'ipAddress' => request()->ip(),
                'userAgent' => request()->header('user-agent'),
            ]
            ,[]));

        $ad->request();
                */

    }


}

function createRequestPayment(FactoryPaymentGateway $creator): void
{
    $creator->connectApi();
}

