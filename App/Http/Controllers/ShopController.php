<?php

namespace App\Http\Controllers;


use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderDetail;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function storeShoppingCart(Request $request){

        $order = PurchaseOrder::create([
            'user_id' => auth()->user()->id,
            'status' => 'CREATE',
            'qty' => $request['totalProduct'],
            'total' => $request['totalPrice'],
        ]);

        // say many relaciones
        foreach ($request['productsPayment'] as $product) {
           // $s = $items['item'];
            PurchaseOrderDetail::create([
                'purchase_order_id' => $order->id,
                'product_id' => $product['id'],
                'qty' => $product['qty'],
                'price' => $product['qty'] * $product['list_price'],
            ]);
        }

        return redirect(route('shop.checkout', $order));
    }
}
