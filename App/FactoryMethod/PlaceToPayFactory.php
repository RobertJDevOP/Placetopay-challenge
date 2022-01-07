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

    public function getFactoryPaymentGateway(): IGatewayApiWallet
    {
        $obj= new BodyArrayPlaceToPayWebC();
        list ($bodyRequest,$purchaseOrderId)=$obj->bodyRequestApi($this->purchaseOrder);

        return new PlaceToPayWebCheckoutApiWallet($bodyRequest,$obj->getEndpointCreateSession(),$purchaseOrderId);
    }

    public function paymentFactoryGateway(): IPaymentGateway
    {
        $obj= new BodyArrayPlaceToPayWebC();
        list ($bodyRequest,$purchaseOrderId)=$obj->bodyRequestApi($this->purchaseOrder);

        return new PlaceToPayWebCheckoutApiWallet($bodyRequest,$obj->getEndpointCreateSession(),$purchaseOrderId);
    }
}
