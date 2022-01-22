<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{

    public function index(Request $request): JsonResponse
    {
        $products = Product::filter($request->input())->paginate(6);

        return response()->json($products);
    }

    public function getCategories(ProductCategory $categories): JsonResponse
    {
        $data = $categories->all();

        return response()->json($data);
    }
}

