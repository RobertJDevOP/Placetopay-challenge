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

    public function request(): void
    {

        print_r($this->bodyRequest);
        $response = Http::post($this->endPointRequest,
            $this->bodyRequest
        );

        dd($response->body());
    }

    public function createPost($content): void
    {
        echo "Send HTTP API requests to create a post in Facebook timeline with content : ".$content."</br>";
    }
}
