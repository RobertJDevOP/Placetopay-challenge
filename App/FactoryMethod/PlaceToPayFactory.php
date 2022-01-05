<?php

namespace App\FactoryMethod;
use App\Helpers\BodyArrayPlaceToPayWebC;
use Illuminate\Database\Eloquent\Model;

/**
 * This Concrete Creator supports Facebook. Remember that this class also
 * inherits the 'post' method from the parent class. Concrete Creators are the
 * classes that the Client actually uses.
 */
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
