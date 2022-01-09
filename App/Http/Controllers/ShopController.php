<?php

namespace App\Http\Controllers;


use App\Models\PurchaseOrder;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function storeShoppingCart(Request $request)//: RedirectResponse
    {
        $order = PurchaseOrder::create([
            'user_id' => auth()->user()->id,
            'qty' => $request['params']['totalProduct'],
            'total' => $request['params']['totalPrice'],
        ]);

        foreach ($request['params']['productsPayment'] as $product) {
            $order->detailsOrder()->create([
                'purchase_order_id' => $order->id,
                'product_id' => $product['id'],
                'qty' => $product['qty'],
                'price' => $product['qty'] * $product['list_price'],
            ]);
        }

        return redirect(route('shop.checkout', $order));
    }
}
