<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderDetail;
use App\ViewModels\Products\IndexViewModel;
use Illuminate\Http\Request;

class ShopController extends Controller
{


    public function storeShoppingCart(Request $request){
//PENDIENTE HACER LOGS PARA EL SISTEMA...... EXCEPCIONES .... VALIDAICONES
//$request['productsPayment']

        $order = PurchaseOrder::create([
            'user_id' => auth()->user()->id,
            'status' => 'CREATE',
            'qty' => $request['totalProduct'],
            'total' => $request['totalPrice'],
        ]);

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
