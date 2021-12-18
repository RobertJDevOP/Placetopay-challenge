<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderDetail;
use App\ViewModels\Products\IndexViewModel;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(IndexViewModel $viewModel)
    {
        $products=Product::select('id','product_name','url_product_img','list_price','category_id','created_at',
            'updated_at','enabled_at','list_price')->with('category')
            ->paginate(6);

        $viewModel->collection($products);

        return view('shop.index', $viewModel->toArray());
    }

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
