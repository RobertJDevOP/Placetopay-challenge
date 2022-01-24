<?php

use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('products/', [ProductController::class, 'index'])->name('api.v1.products.index');
Route::get('product/{product}', [ProductController::class, 'show'])->name('api.v1.product.show');
