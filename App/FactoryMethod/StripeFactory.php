<?php

namespace App\FactoryMethod;

class StripeFactory extends FactoryPaymentGateway
{
    private string $email, $password;

    public function __construct(string $email, string $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    public function getFactoryPaymentGateway(): IPaymentGatewayApi
    {
        return new StripeApi($this->email, $this->password);
    }
}
