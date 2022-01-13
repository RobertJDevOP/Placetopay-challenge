<?php

namespace App\Factory\WebCheckoutPlaceToPay;

use App\Factory\FactoryApiWalletGateway;
use App\Helpers\ArrayHelperWebCheckout;
use Illuminate\Database\Eloquent\Model;
use App\Factory\IGatewayApiWallet;

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
        $obj= new ArrayHelperWebCheckout();
        list ($bodyRequest,$purchaseOrderId)=$obj->bodyRequestApi($this->purchaseOrder);

        return new PlaceToPayWebCheckoutApiWallet($bodyRequest,$obj->getEndpointCreateSession(),$purchaseOrderId,null);
    }

    public function getRequestInformationGatewayApiWallet(): IGatewayApiWallet
    {
        $obj= new ArrayHelperWebCheckout();
        $bodyRequest=$obj->bodyRequestInformationApi();

        return new PlaceToPayWebCheckoutApiWallet($bodyRequest,$obj->getEndpointCreateSession(),$this->purchaseOrderId,$this->requestId);
    }
}
