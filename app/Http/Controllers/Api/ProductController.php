<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{

    public function productsWithFilters(Request $request): JsonResponse
    {
        $products = Product::filter($request->input())->paginate(6);

        return response()->json($products);
    }

    public function index()
    {
        return  ProductCollection::make(Product::with('category')->get());
    }

    public function show(Product $product)
    {
        return  ProductResource::make($product);
    }

    public function getCategories(ProductCategory $categories): JsonResponse
    {
        $data = $categories->all();

        return response()->json($data);
    }
}

