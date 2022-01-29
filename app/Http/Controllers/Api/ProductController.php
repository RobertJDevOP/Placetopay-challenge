<?php

namespace App\Http\Controllers\Api;

use App\Actions\Api\Product\DeleteAction;
use App\Actions\Api\Product\StoreAction;
use App\Actions\Api\Product\UpdateAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\Product\ProductDeleteResource;
use App\Http\Resources\Product\ProductCollection;
use App\Http\Resources\Product\ProductResource;
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

    public function getCategories(ProductCategory $categories): JsonResponse
    {
        $data = $categories->all();

        return response()->json($data);
    }

    public function index(): ProductCollection
    {
        return  ProductCollection::make(Product::with('category')->get());
    }

    public function show(Product $product): ProductResource
    {
        return  ProductResource::make($product);
    }

    public function store(Request $request,StoreAction $storeAction): ProductResource
    {
        $product = $storeAction::execute($request);

        return new ProductResource($product);
    }

    public function update(Request $request,Product $product,UpdateAction $updateAction): ProductResource
    {
        $product = $updateAction::execute($product,$request);

        return new ProductResource($product);
    }

    public function destroy(Product $product,DeleteAction $deleteAction): ProductDeleteResource
    {
        $product = $deleteAction::execute($product);

        return new ProductDeleteResource($product);
    }

}

