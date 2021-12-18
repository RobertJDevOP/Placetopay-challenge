<?php

namespace App\Services;

use App\Contracts\ApiInterface;
use Illuminate\Support\Facades\Http;

class ApiAdapter implements  ApiInterface
{
    private object $clase;

    public  function __construct(ApiPlaceToPay $apiPlaceToPay)
    {
        $this->clase = $apiPlaceToPay;
    }

    public function request()
    {

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post($this->clase->endopint, [
            $this->clase->params
        ]);

        dd( $this->clase->params);

        $response->body();
    }

    public function getResponse(object $params)
    {
        // TODO: Implement getResponse() method.
    }
}
