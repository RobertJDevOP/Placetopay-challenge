<?php

namespace App\FactoryMethod;

use Illuminate\Support\Facades\Http;

class PlaceToPayWebCheckoutApi implements IPaymentGatewayApi
{
    private array $bodyRequest;
    private string $endPointRequest;

    public function __construct(array $bodyRequest,string $endPointRequest)
    {
        $this->bodyRequest = $bodyRequest;
        $this->endPointRequest = $endPointRequest;
    }

    public function makeRequest(): object
    {
        return Http::post($this->endPointRequest,
            $this->bodyRequest
        );
    }

    public function getBodyResponse(object $request): void
    {
        $request->body();
    }
}
