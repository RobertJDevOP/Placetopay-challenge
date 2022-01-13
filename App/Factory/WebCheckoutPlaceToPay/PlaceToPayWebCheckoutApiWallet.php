<?php

namespace App\Factory\WebCheckoutPlaceToPay;


use App\Helpers\RestApiWallet\WalletResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use App\Factory\IGatewayApiWallet;

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

        return  WalletResponse::customApiResponse($bodyResponse,$this->purchaseOrderId,$this->endPointRequest,$this->requestId);
    }

    public function getRequestInformation(): object
    {
        return Http::post($this->endPointRequest.'/'.$this->requestId,
            $this->bodyRequest
        );
    }




}
