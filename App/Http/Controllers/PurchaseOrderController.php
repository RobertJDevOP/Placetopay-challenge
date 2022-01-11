<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use App\Models\PurchasePaymentStatus;
use App\ViewModels\PurchaseOrder\IndexViewModel;

use Illuminate\Support\Facades\Auth;

class PurchaseOrderController extends Controller
{
    public function index(IndexViewModel $viewModel)
    {
        $orders=PurchaseOrder::select('purchase_order.id','qty','total','purchase_order.created_at','purchase_order.updated_at')
            ->join('purchase_payment_status', 'purchase_payment_status.id_purchase_order', '=', 'purchase_order.id')
            ->where('user_id', '=', auth()->user()->id)
            ->paginate(5);
        $viewModel->collection($orders);


        return view('orders.index', $viewModel->toArray());
    }

    public function index2()
    {

        $purchaseOrders = PurchaseOrder::where('user_id', '=', auth()->user()->id)->paginate(5);

        $ordersPaymentDetails = array();

        foreach ($purchaseOrders as $row){
            $ordersPaymentDetails[$row->id]=$row;
            foreach ($row->purchasePaymentsStatus as $row2){
                $ordersPaymentDetails[$row->id][$row2->id_purchase_order]=$row2['purchase_payments_status'];
            }
        }

       return response()->json($ordersPaymentDetails);

    }

}
