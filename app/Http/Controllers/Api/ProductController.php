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

    public function index(): ProductCollection
    {
        return  ProductCollection::make(Product::with('category')->get());
    }

    public function show(Product $product): ProductResource
    {
        return  ProductResource::make($product);
    }

    public function getCategories(ProductCategory $categories): JsonResponse
    {
        $data = $categories->all();

        return response()->json($data);
    }

    public function store(Request $request)
    {
        $product = new Product();
        $product->product_name = $request->product_name;
        $product->category_id = $request->category_id;
        $product->list_price = $request->list_price;
        $product->price = $request->price;
        $product->url_product_img = 'default_product_picture.png';
        if($product->save()){
            return new ProductResource($product);
        }
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->product_name = $request->product_name;
        $product->category_id = $request->category_id;
        $product->list_price = $request->list_price;
        $product->price = $request->price;
        $product->url_product_img = 'default_product_picture.png';
        if($product->save()){
            return new ProductResource($product);
        }
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if($product->delete())
        {
            return new ProductResource($product);
        }
    }

}

