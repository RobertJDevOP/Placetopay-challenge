<?php

namespace App\Helpers\RestApiWallet;

use App\Entities\Status;
use App\Models\PurchasePaymentStatus;
use Illuminate\Http\JsonResponse;

class WalletResponse
{

    public static  function customApiResponse(array $jsonObject,?int $purchaseOrderId,?string $endPointRequest,?string $requestId):JsonResponse
    {
        $statusCode= ($jsonObject['status'])?$jsonObject['status']['status']:   $statusCode = 500;

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

                $purchasePaymentStatus->id_purchase_order= $purchaseOrderId;
                $purchasePaymentStatus->requestId= $jsonObject['requestId'];
                $purchasePaymentStatus->processUrl= $jsonObject['processUrl'];
                $purchasePaymentStatus->status=  Status::OK;
                $purchasePaymentStatus->save();
                break;
            case 'APPROVED':
                $response['message'] = Status::APPROVED;
                $response['status'] = 200;

                $purchasePaymentStatus->id_purchase_order= $purchaseOrderId;
                $purchasePaymentStatus->requestId= $jsonObject['requestId'];
                $purchasePaymentStatus->processUrl= $endPointRequest.'/'.$requestId;
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

                $purchasePaymentStatus->id_purchase_order= $purchaseOrderId;
                $purchasePaymentStatus->requestId= $jsonObject['requestId'];
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
