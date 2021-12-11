<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\ViewModels\Products\IndexViewModel;

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
}
