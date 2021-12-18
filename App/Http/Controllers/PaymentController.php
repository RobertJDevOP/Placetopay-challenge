<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use App\Services\PlaceToPayWebCheckout;

class PaymentController extends Controller
{
    public function purchaseToPay(PurchaseOrder $order,PlaceToPayWebCheckout $xd ){

        $xd::requestxd($order);

    }

    public function payment(Order $order, $response)
    {
        // capturar response

        $order->update([
            'status' => 'ERRORXD'
        ]);


    }
}
