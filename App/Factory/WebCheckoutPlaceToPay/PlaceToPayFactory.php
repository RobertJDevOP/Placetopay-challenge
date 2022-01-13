<?php

namespace App\Factory;
use App\Helpers\BodyArrayPlaceToPayWebC;
use Illuminate\Database\Eloquent\Model;

class PlaceToPayFactory extends FactoryApiWalletGateway
{
    private ?Model $purchaseOrder;
    private ?string $requestId;
    private ?int $purchaseOrderId;

    public function __construct(?Model $purchaseOrder,?string $requestId,?int $purchaseOrderId)
    {
        $this->purchaseOrder = $purchaseOrder;
        $this->requestId = $requestId;
        $this->purchaseOrderId = $purchaseOrderId;
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

        return new PlaceToPayWebCheckoutApiWallet($bodyRequest,$obj->getEndpointCreateSession(),$this->purchaseOrderId,$this->requestId);
    }
}
