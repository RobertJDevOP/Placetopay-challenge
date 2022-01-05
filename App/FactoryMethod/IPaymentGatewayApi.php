<?php

namespace App\FactoryMethod;

interface IPaymentGatewayApi
{
    public function request(): void;

    public function createPost($content): void;
}
