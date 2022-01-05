<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BodyArrayPlaceToPayWebC
{
    private string $login,$apiKey,$endpointCreateSession,$tranKey,$seed,$nonce,$locale;

    function __construct()
    {
        $this->login =config('app.LOGIN_TEST_APPLICATION_PLACETOPAY_WEBCHECKOUT');
        $this->apiKey =config('app.TRANKEY_TEST_APPLICATION_PLACETOPAY_WEBCHECKOUT');
        $this->endpointCreateSession =config('app.CREATE_REQUEST_ENDPOINT_TEST_PLACETOPAY_WEBCHECKOUT');
        $this->locale =config('app.LOCALE_TEST_APPLICATION_PLACETOPAY_WEBCHECKOUT');
        $this->seed =date("c");
        $this->nonce =Str::random();
        $this->tranKey= base64_encode(sha1($this->nonce.$this->seed.$this->apiKey, true));
    }

    public function getEndpointCreateSession(): string
    {
        return $this->endpointCreateSession;
    }

    public function bodyRequestApi(Model $purchaseOrder): array
    {
      $items=array();

      foreach ($purchaseOrder->detailsOrder as  $detailOrder){
          foreach($detailOrder->products as $product){
             $items [] =['name'=>$product['product_name'],'qty'=>$detailOrder['qty'],'price'=>$detailOrder['price'],'category'=>'physical'];
          }
      }

      return [
           'locale' => $this->locale,
           'auth' => [
               'login' => $this->login,
               'tranKey' => $this->tranKey,
               'nonce' => base64_encode($this->nonce),
               'seed' => $this->seed,
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
                   'item' => $items,
               ]
           ],
           'expiration' => date('c', strtotime('+1 hour')),
           'returnUrl' => 'https://dnetix.co/p2p/client',
           'ipAddress' => request()->ip(),
           'userAgent' => request()->header('user-agent'),
       ];
    }

}
