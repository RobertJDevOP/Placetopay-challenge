<?php

namespace App\FactoryMethod;

interface IPaymentGateway
{
    public function makePayment(): object;
}
