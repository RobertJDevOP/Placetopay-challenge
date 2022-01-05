<?php

namespace App\FactoryMethod;

use App\Entities\Status;
use Illuminate\Http\JsonResponse;
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

    public function getBodyResponse(object $request):JsonResponse
    {
        $bodyResponse = json_decode($request->body(),true);

        return $this->customApiResponse($bodyResponse);
    }

    private function customApiResponse(array $jsonObject):JsonResponse
    {

        if ($jsonObject['status']){
            $statusCode=$jsonObject['status']['status'];
        } else {
            $statusCode = 500;
        }

        $response = array();

        switch ($statusCode) {
            case 'UNAUTHORIZED':
                $response['message'] = Status::UNAUTHORIZED;
                $response['status'] = 401;
                break;
            case 'OK':
                $response['message'] = Status::OK;
                $response['processUrl'] = $jsonObject['processUrl'];
                $response['requestId'] = $jsonObject['requestId'];
                $response['status'] = 200;
                break;
            default:
                $response['message'] = ($statusCode == 500) ? 'Whoops, looks like something went wrong error xd':'';
                break;
        }


        return response()->json($response,  $response['status']);
    }


}
