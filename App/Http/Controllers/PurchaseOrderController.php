<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use App\ViewModels\PurchaseOrder\IndexViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseOrderController extends Controller
{
    public function index(IndexViewModel $viewModel)
    {
        $userId = Auth::user()->id;
        $products=PurchaseOrder::select('id','status','qty','total','created_at','updated_at')
            ->where('user_id', '=', $userId)
            ->paginate(5);
        $viewModel->collection($products);

        return view('orders.index', $viewModel->toArray());
    }
}
