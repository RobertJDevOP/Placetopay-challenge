<?php

namespace Tests\PurchaseOrder\StoreTest;

use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderDetail;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;

class StoreTest extends TestCase
{
    use RefreshDatabase;

    protected User $client;
    protected PurchaseOrder $purchaseOrder;
    protected PurchaseOrderDetail $purchaseOrderDetail;
    protected Product $product;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan("db:seed", ['--class' => 'RoleSeeder']);
        $this->client = User::factory()->create();
        $this->client->assignRole('cliente');
        $this->product = Product::factory()->create();
        $this->purchaseOrder = PurchaseOrder::factory()->create();
        $this->purchaseOrderDetail = PurchaseOrderDetail::factory()->create();
    }


    public function test_it_i_can_make_a_purchase_order():void
    {
        $this->withoutExceptionHandling();
        $purchaseOrder = $this->orderProvider() ;

        $response =  $this->actingAs($this->client)->post('/storeShoppingCart',$purchaseOrder);
        $purchaseOrderA = PurchaseOrder::orderBy('id', 'desc')->first();
        $purchaseOrderDetailA = PurchaseOrderDetail::orderBy('purchase_order_id', 'desc')->first();

        $response->assertStatus(302);
        $this->assertEquals($purchaseOrder['params']['totalProduct'], $purchaseOrderA->qty);
        $this->assertEquals($purchaseOrder['params']['totalPrice'], $purchaseOrderA->total);
        $this->assertEquals($purchaseOrder['params']['productsPayment'][0]['list_price'], $purchaseOrderDetailA->price);
        $this->assertEquals(1, $purchaseOrderDetailA->product_id);
    }


    public function orderProvider(): array
    {
        return [
            'params' =>[
                'totalProduct' => 1,
                'totalPrice' => 300000,
                'productsPayment'=>[
                   0 =>[
                       'id' =>$this->product['id'],
                       'qty' => 1,
                       'list_price' =>300000,
                   ],
                ],
                'wallet'=>'placetopay'
            ]
        ];
    }



}

