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
        $products=Product::filter($request->input('filters', []))->paginate(6);

        return response()->json($products);


        /*  $products = $this->productRepositories->all();

          return response()->json($products); */
    }
}

