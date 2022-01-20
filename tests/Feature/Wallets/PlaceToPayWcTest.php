<?php

namespace Tests\Feature\Wallets;

use App\Factory\FactoryApiWalletGateway;
use App\Factory\WebCheckoutPlaceToPay\PlaceToPayFactory;
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

    public function test_it_get_a_redirect_url_as_response(): void
    {
        User::factory()->create();
        Product::factory()->create();
        $purchaseOrder = PurchaseOrder::factory()
            ->has(PurchaseOrderDetail::factory()->count(3), 'detailsOrder')
            ->create();
        Http::fake([
            'https://dev.placetopay.com/redirection/*' => Http::response(['processUrl'=> 'https://github.com/RobertJDevOP'],200)
        ]);

        $paymentGateway = app()->make(FactoryApiWalletGateway::class,[$purchaseOrder,null,null,'placetopay']);

        $response = $paymentGateway->apiConnect();


        $this->assertNotNull($response->getData()->processUrl);
    }


}
