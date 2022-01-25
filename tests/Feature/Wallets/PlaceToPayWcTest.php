<?php

namespace Tests\Feature\Wallets;

use App\Factory\FactoryApiWalletGateway;
use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderDetail;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class PlaceToPayWcTest extends TestCase
{
    use RefreshDatabase;
    //pendientes mas tests.

    public function test_it_get_a_redirect_url_as_response(): void
    {
        $purchaseOrder=$this->fakeHttpCreateRequest();
        Http::fake([
            'https://dev.placetopay.com/redirection/*' => Http::response(['processUrl'=> 'https://github.com/RobertJDevOP'],200)
        ]);

        $paymentGateway = app()->make(FactoryApiWalletGateway::class,[$purchaseOrder,null,null,'placetopay']);
        $response = $paymentGateway->apiConnect();

        $this->assertNotNull($response->getData()->processUrl);
    }


    public function test_it_get_request_information(): void
    {
        $placeToPayResponse = $this->placeToPayWebCheckoutResponse();
        $purchaseOrder = $this->fakeHttpCreateSesion();
        Http::fake([
            'https://checkout-co.placetopay.dev/api/session/123123' => Http::response($placeToPayResponse,200)
        ]);

        $paymentGateway = app()->make(FactoryApiWalletGateway::class,[null,$placeToPayResponse['requestId'],$purchaseOrder->id,'placetopay']);
        $response= $paymentGateway->apiRequestStatus();
        $data=json_decode($response->getContent(),true);

        $this->assertEquals($placeToPayResponse['requestId'], $data['requestId']);
    }

    public function fakeHttpCreateSesion(): \Illuminate\Database\Eloquent\Model
    {
        User::factory()->create();
        Product::factory()->create();

        $purchaseOrder = PurchaseOrder::factory()
            ->has(PurchaseOrderDetail::factory()->count(3), 'detailsOrder')
            ->create();

        $this->placeToPayWebCheckoutResponse();

        $paymentGateway = app()->make(FactoryApiWalletGateway::class,[$purchaseOrder,null,null,'placetopay']);
        $paymentGateway->apiConnect();

        return $purchaseOrder;
    }


    public function fakeHttpCreateRequest(): \Illuminate\Database\Eloquent\Model
    {
        User::factory()->create();

        Product::factory()->create();

        return PurchaseOrder::factory()
            ->has(PurchaseOrderDetail::factory()->count(3), 'detailsOrder')
            ->create();
    }

    public function placeToPayWebCheckoutResponse($status = 'OK'): array
    {
        return [
            'status' => [
                'status'=> $status,
                'reason'=> 'PC',
                'message'=> 'La petición se ha procesado correctamente',
                'date'=> '2021-11-30T15:08:27-05:00',
            ],
            'requestId'=> '123123',
            'processUrl'=> 'https://checkout-co.placetopay.com/session/1/cc9b8690b1f7228c78b759ce27d7e80a',
        ];
    }
}
