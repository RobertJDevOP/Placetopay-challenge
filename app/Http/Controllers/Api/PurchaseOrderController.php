<?php

namespace App\Http\Controllers\Api;

use App\Models\PurchaseOrder;
use Illuminate\Http\JsonResponse;

class PurchaseOrderController
{
    public function index(): JsonResponse
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
