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
    private ?int $purchaseOrderId;
    private ?string $requestId;

    public function __construct(array $bodyRequest,string $endPointRequest,?int $purchaseOrderId,?string $requestId)
    {
        $this->bodyRequest = $bodyRequest;
        $this->endPointRequest = $endPointRequest;
        $this->purchaseOrderId = $purchaseOrderId;
        $this->requestId = $requestId;
    }

    public function createRequest(): object
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

    public function getRequestInformation(): object
    {
        return Http::post($this->endPointRequest.'/'.$this->requestId,
            $this->bodyRequest
        );
    }



    private function customApiResponse(array $jsonObject):JsonResponse
    {

        //dd($jsonObject);
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
            case 'APPROVED':
                $response['message'] = Status::APPROVED;
                $response['status'] = 200;

                PurchaseOrder::where('requestId',  $jsonObject['requestId'])
                    ->update(['status'  =>  Status::APPROVED,
                    ]);
                break;
            case 'PENDING':
                $response['message'] = Status::PENDING;
                $response['status'] = 200;

                PurchaseOrder::where('requestId',  $jsonObject['requestId'])
                    ->update(['status'  =>  Status::PENDING,
                    ]);
                break;
            default:
                $response['message'] = ($statusCode == 500) ? 'Whoops, looks like something went wrong error xd':'';
                break;
        }


        return response()->json($response,  $response['status']);
    }


}
