<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    private $productRepositories;

    public function __construct(ProductRepository $productRepositories)
    {
        $this->productRepositories = $productRepositories;
    }

    public function index(Request $request): JsonResponse
    {

        //dd($request->input('filters', []));
        $products=Product::filter($request->input('filters', []))->paginate();
                /*->
        select('id','product_name','url_product_img','list_price','category_id','created_at',
            'updated_at','enabled_at','list_price')->with('category')>paginate(6);*/
        //    ->SearchByField('product_name','%Architecto%','like')

//        dd($xd);

       return response()->json($products);
        /*  $products = $this->productRepositories->all();

          return response()->json($products); */
    }
}

