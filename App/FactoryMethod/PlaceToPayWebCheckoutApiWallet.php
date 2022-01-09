<?php

namespace App\FactoryMethod;

use App\Entities\Status;
use App\Models\PurchaseOrder;
use App\Models\PurchasePaymentStatus;
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

        if ($jsonObject['status']){
            $statusCode=$jsonObject['status']['status'];
        } else {
            $statusCode = 500;
        }

        $response = array();
        $purchasePaymentStatus=new PurchasePaymentStatus();


        switch ($statusCode) {
            case 'FAILED':
                $response['message'] = Status::FAILED;
                $response['status'] = 401;
                break;
            case 'UNAUTHORIZED':
                $response['message'] = Status::UNAUTHORIZED;
                $response['status'] = 401;
                break;
            case 'OK':
                $response['message'] = Status::OK;
                $response['processUrl'] = $jsonObject['processUrl'];
                $response['requestId'] = $jsonObject['requestId'];
                $response['status'] = 200;

                $purchasePaymentStatus->id_purchase_order= $this->purchaseOrderId;
                $purchasePaymentStatus->requestId= $jsonObject['requestId'];
                $purchasePaymentStatus->processUrl= $jsonObject['processUrl'];
                $purchasePaymentStatus->status=  Status::OK;
                $purchasePaymentStatus->save();

                break;
            case 'APPROVED':
                $response['message'] = Status::APPROVED;
                $response['status'] = 200;

                $purchasePaymentStatus->id_purchase_order= $this->purchaseOrderId;
                $purchasePaymentStatus->requestId= $jsonObject['requestId'];
                $purchasePaymentStatus->processUrl= $this->endPointRequest.'/'.$this->requestId;
                $purchasePaymentStatus->status=  Status::APPROVED;
                $purchasePaymentStatus->save();


                break;
            case 'PENDING':
                $response['message'] = Status::PENDING;
                $response['status'] = 200;


                $purchasePaymentStatus->status=  Status::PENDING;
                $purchasePaymentStatus->save();

                break;
            case 'REJECTED':
                $response['message'] = Status::REJECTED;
                $response['status'] = 200;

                $purchasePaymentStatus->requestId= $jsonObject['requestId'];
                $purchasePaymentStatus->processUrl= $jsonObject['processUrl'];
                $purchasePaymentStatus->status=  Status::REJECTED;
                $purchasePaymentStatus->save();
                break;
            default:
                $response['message'] = ($statusCode == 500) ? 'Whoops, looks like something went wrong error xd':'';
                break;
        }


        return response()->json($response,  $response['status']);
    }


}
