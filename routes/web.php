<?php


use App\Http\Controllers\Api\PurchaseOrderController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;

use App\Http\Controllers\ReportController;
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

    //System report
    Route::get('/reports', function () {
        return view('reports.index');
    });
    Route::post('/generateReport', [ReportController::class,'store']);
    Route::get('api/reports/', [ReportController::class,'index']);
    Route::post('api/exportProducts',[ProductController::class,'generateReport']);
    Route::get('api/getReportStatus/{typeReport}', [ProductController::class,'getExportStatus']);
    Route::post('api/importProducts',[ProductController::class,'importProducts']);
});




    Route::group(['middleware' => ['role:cliente','auth','verified']], function () {
    Route::get('/shop', function () {
        return view('shop.index');
    });
    Route::name('shop.store')->post('/storeShoppingCart', [ShopController::class, 'storeShoppingCart']);
    Route::name('shop.checkout')->get('/checkout/{purchaseOrder}/{wallet}', [PaymentController::class, 'createRequest']);
    Route::name('payment.checkout')->get('/payment/{order}',[PaymentController::class,'getRequestInformation']);
    Route::get('/orders', function () {
        return view('orders.index');
    });


    // refactorizar debe estar en api y usar token de autenticacion
    Route::post('/retryPayment', [PaymentController::class, 'retryPayment']);
    Route::get('api/orders/',[PurchaseOrderController::class,'index']);

});


Route::get('/dashboard', DashboardController::class)
    ->middleware(['auth', 'verified'])->name('dashboard');


