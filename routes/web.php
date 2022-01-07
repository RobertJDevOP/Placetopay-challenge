<?php


use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');


Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect(RouteServiceProvider::HOME);
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::group(['middleware' => ['role:admin','auth','verified']], function () {
    Route::name('users.index')->get('/users', [UserController::class, 'index']);
    Route::name('users.edit')->get('/users/{email}/edit', [UserController::class, 'edit']);
    Route::name('users.update')->put('/users/{email}/', [UserController::class, 'update']);
    Route::name('users.status')->put('/users/{email}/status', [UserController::class, 'statusUser']);

    Route::name('products.index')->get('/products', [ProductController::class, 'index']);
    Route::name('product.create')->get('/product/create', [ProductController::class, 'categories']);
    Route::name('product.register')->post('/product/register', [ProductController::class, 'register']);
    Route::name('product.status')->put('/product/{id}/status', [ProductController::class, 'statusProduct']);
    Route::name('product.edit')->get('/product/{id}/edit', [ProductController::class, 'edit']);
    Route::name('product.update')->put('/product/{id}/', [ProductController::class, 'update']);
});


Route::group(['middleware' => ['role:cliente','auth','verified']], function () {
    Route::get('/shop', function () {
        return view('shop.index');
    });
    Route::name('shop.store')->post('/storeShoppingCart', [ShopController::class, 'storeShoppingCart']);
    Route::name('shop.checkout')->get('/checkout/{purchaseOrder}', [PaymentController::class, 'createRequest']);

    Route::name('payment.checkout')->get('/payment/{order}',[PaymentController::class,'paymentResponse']);

    Route::name('orders.index')->get('/orders',[PurchaseOrderController::class,'index']);
   // Route::get('/orders/payment/{order}', 'PaymentController@payment')->name('payment');
});



Route::get('/dashboard', DashboardController::class)
    ->middleware(['auth', 'verified'])->name('dashboard');



Route::name('TEST')->get('/productRepositories', [ProductController::class, 'index2']);
