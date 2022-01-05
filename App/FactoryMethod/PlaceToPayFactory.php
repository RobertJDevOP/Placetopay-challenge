<?php

namespace App\FactoryMethod;
use App\Helpers\BodyArrayPlaceToPayWebC;
use Illuminate\Database\Eloquent\Model;

class PlaceToPayFactory extends FactoryPaymentGateway
{
    private Model $purchaseOrder;

    public function __construct(Model $purchaseOrder)
    {
        $this->purchaseOrder = $purchaseOrder;
    }

    public function getFactoryPaymentGateway(): IPaymentGatewayApi
    {
        $obj= new BodyArrayPlaceToPayWebC();
        $bodyRequest=$obj->bodyRequestApi($this->purchaseOrder);

        return new PlaceToPayWebCheckoutApi($bodyRequest,$obj->getEndpointCreateSession());
    }
}
