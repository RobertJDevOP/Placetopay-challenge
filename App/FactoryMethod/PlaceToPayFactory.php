<?php

namespace App\FactoryMethod;
use App\Helpers\BodyArrayPlaceToPayWebC;
use Illuminate\Database\Eloquent\Model;

class PlaceToPayFactory extends FactoryApiWalletGateway
{
    private ?Model $purchaseOrder;
    private ?string $requestId;

    public function __construct(?Model $purchaseOrder,?string $requestId)
    {
        $this->purchaseOrder = $purchaseOrder;
        $this->requestId = $requestId;
    }

    public function createRequestGatewayApiWallet(): IGatewayApiWallet
    {
        $obj= new BodyArrayPlaceToPayWebC();
        list ($bodyRequest,$purchaseOrderId)=$obj->bodyRequestApi($this->purchaseOrder);

        return new PlaceToPayWebCheckoutApiWallet($bodyRequest,$obj->getEndpointCreateSession(),$purchaseOrderId,null);
    }

    public function getRequestInformationGatewayApiWallet(): IGatewayApiWallet
    {
        $obj= new BodyArrayPlaceToPayWebC();
        $bodyRequest=$obj->bodyRequestInformationApi();

        return new PlaceToPayWebCheckoutApiWallet($bodyRequest,$obj->getEndpointCreateSession(),null,$this->requestId);
    }
}
