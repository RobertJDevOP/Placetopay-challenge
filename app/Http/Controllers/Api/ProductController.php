<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Repositories\ProductRepository;

class ProductController extends Controller
{
    private $productRepositories;

    public function __construct(ProductRepository $productRepositories)
    {
        $this->productRepositories = $productRepositories;
    }

    public function index()
    {
        $products=Product::select('id','product_name','url_product_img','list_price','category_id','created_at',
            'updated_at','enabled_at','list_price')->with('category')
            ->paginate(6);

       // dd($products);

        return response()->json($products);
        /*  $products = $this->productRepositories->all();

          return response()->json($products); */
    }
}

