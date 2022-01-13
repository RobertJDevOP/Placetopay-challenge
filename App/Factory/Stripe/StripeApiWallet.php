<?php

namespace App\Factory;

use Illuminate\Http\JsonResponse;

class StripeApiWallet implements IGatewayApiWallet
{
    private string $email, $password;

    public function __construct(string $email, string $password)
    {
        $this->email = $email;
        $this->password = $password;
    }


    public function createRequest(): object
    {
        // TODO: Implement createRequest() method.
    }

    public function getBodyResponse(object $request): JsonResponse
    {
        // TODO: Implement getBodyResponse() method.
    }

    public function getRequestInformation(): object
    {
        // TODO: Implement getRequestInformation() method.
    }
}
