<?php

use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('products/', [ProductController::class, 'index'])->name('api.v1.products.index');
Route::get('product/{product}', [ProductController::class, 'show'])->name('api.v1.product.show');
Route::put('product/{product}', [ProductController::class, 'update'])->name('api.v1.product.update');
Route::delete('product/{product}', [ProductController::class, 'destroy'])->name('api.v1.product.destroy');
Route::post('product', [ProductController::class, 'store'])->name('api.v1.product.store');
