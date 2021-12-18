<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use App\Services\ApiAdapter;
use App\Services\ApiPlaceToPay;
use App\Services\PlaceToPayWebCheckout;

class PaymentController extends Controller
{
    public function purchaseToPay(PurchaseOrder $purchaseOrder,PlaceToPayWebCheckout $xd ){


        foreach ($purchaseOrder->detailsOrder as  $key){
            foreach($key->products as $key2){
                $detailsOrder [] =['name'=>$key2['product_name'],'qty'=>$key['qty'],'price'=>$key['price'],'category'=>'physical'];
            }
        }
        //$xd::requestxd($order);


        $ad= new ApiAdapter( new ApiPlaceToPay('https://test.placetopay.com/redirection/api/session',

            [
                'locale' => 'es_CO',
                'auth' => [
                    'login' => 'c51ce410c124a10e0db5e4b97fc2af39',
                    'tranKey' => 'VQOcRcVH2DfL6Y4B4SaK6yhoH/VOUveZ3xT16OQnvxE=',
                    "nonce" =>"NjE0OWVkODgwYjNhNw==",
                    "seed" => "2021-09-21T09:34:48-05:00",
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
