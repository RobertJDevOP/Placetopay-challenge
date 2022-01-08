<?php

namespace App\FactoryMethod;

class StripeFactory extends FactoryApiWalletGateway
{
    private string $email, $password;

    public function __construct(string $email, string $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    public function getFactoryPaymentGateway(): IGatewayApiWallet
    {
        return new StripeApiWallet($this->email, $this->password);
    }
}
