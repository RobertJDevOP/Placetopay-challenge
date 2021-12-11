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
        $products = $this->productRepositories->all();

        return response()->json($products);
    }
}
