<?php

namespace App\FactoryMethod;

use App\Entities\Status;
use App\Models\PurchaseOrder;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class PlaceToPayWebCheckoutApiWallet implements IGatewayApiWallet
{
    private array $bodyRequest;
    private string $endPointRequest;
    private int $purchaseOrderId;

    public function __construct(array $bodyRequest,string $endPointRequest,int $purchaseOrderId)
    {
        $this->bodyRequest = $bodyRequest;
        $this->endPointRequest = $endPointRequest;
        $this->purchaseOrderId = $purchaseOrderId;
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

                PurchaseOrder::where('id',   $this->purchaseOrderId)
                              ->update(['requestId' => $jsonObject['requestId'],
                                        'processUrl'  =>  $jsonObject['processUrl'],
                                        'status'  =>  Status::OK,
                ]);
                break;
            default:
                $response['message'] = ($statusCode == 500) ? 'Whoops, looks like something went wrong error xd':'';
                break;
        }


        return response()->json($response,  $response['status']);
    }


}
