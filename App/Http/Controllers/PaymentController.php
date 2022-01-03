<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use App\Services\ApiAdapter;
use App\Services\ApiPlaceToPay;
use App\Services\PlaceToPayWebCheckout;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    /**
     * @throws \Exception
     */
    public function purchaseToPay(PurchaseOrder $purchaseOrder, PlaceToPayWebCheckout $xd ){


        foreach ($purchaseOrder->detailsOrder as  $key){
            foreach($key->products as $key2){
                $detailsOrder [] =['name'=>$key2['product_name'],'qty'=>$key['qty'],'price'=>$key['price'],'category'=>'physical'];
            }
        }

    // fabrica de objetos


        $apiKey='024h1IlD';
        $nonce=Str::random();
        $seed=date("c");
        $result=$nonce.$seed.$apiKey;
        $tranKey = base64_encode(sha1($result, true));
        //$endpoint='https://checkout-test.placetopay.com/api/session';
         $endpoint='https://checkout-co.placetopay.dev/api/session';
        //$endpoint='https://test.placetopay.com/redirection/api/session';



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
                'returnUrl' => route('payment', [$purchaseOrder->id]),
                'ipAddress' => request()->ip(),
                'userAgent' => request()->header('user-agent'),
            ]
            ,[]));
        $ad->request();


    }


}
