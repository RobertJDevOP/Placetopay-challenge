<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use App\ViewModels\PurchaseOrder\IndexViewModel;

use Illuminate\Support\Facades\Auth;

class PurchaseOrderController extends Controller
{
    public function index(IndexViewModel $viewModel)
    {
        $products=PurchaseOrder::select('id','qty','total','created_at','updated_at')
            ->where('user_id', '=', auth()->user()->id)
            ->paginate(5);
        $viewModel->collection($products);

        return view('orders.index', $viewModel->toArray());
    }



}
