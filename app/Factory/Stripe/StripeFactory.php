<?php

namespace App\Factory;

use App\Helpers\ArrayHelperWebCheckout;

class StripeFactory extends FactoryApiWalletGateway
{
    private string $email, $password;

    public function __construct(string $email, string $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    public function createRequestGatewayApiWallet(): IGatewayApiWallet
    {
        $obj = new ArrayHelperWebCheckout();
        list ($bodyRequest, $purchaseOrderId) = $obj->bodyRequestApi($this->purchaseOrder);

        return new PlaceToPayWebCheckoutApiWallet($bodyRequest, $obj->getEndpointCreateSession(), $purchaseOrderId, null);
    }

    public function getRequestInformationGatewayApiWallet(): IGatewayApiWallet
    {
        $obj = new ArrayHelperWebCheckout();
        $bodyRequest = $obj->bodyRequestInformationApi();

        return new PlaceToPayWebCheckoutApiWallet($bodyRequest, $obj->getEndpointCreateSession(), $this->purchaseOrderId, $this->requestId);
    }

}
