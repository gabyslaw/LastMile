<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'v1'], function(){
    Route::get('/', function() {
        return 'Last MIls API version 1.0';
    });
    Route::group(['prefix' => 'order'], function() {
        Route::get('/', [\App\Http\Controllers\Order\OrderController::class,'index']);
        Route::post('/order', [\App\Http\Controllers\Order\OrderController::class,'store']);
        Route::get('/order/{id}', [\App\Http\Controllers\Order\OrderController::class,'store']);
        Route::put('/order/{id}', [\App\Http\Controllers\Order\OrderController::class,'update']);
        Route::delete('/order/{id}', [\App\Http\Controllers\Order\OrderController::class, 'destroy']);
    });
    Route::group(['prefix' => 'customer'], function() {
        Route::get('/', [\App\Http\Controllers\Customer\CustomerController::class, 'index']);
        Route::post('/', [\App\Http\Controllers\Customer\CustomerController::class, 'store']);
        Route::get('/{id}', [\App\Http\Controllers\Customer\CustomerController::class, 'show']);
        Route::put('/{id}', [\App\Http\Controllers\Customer\CustomerController::class, 'update']);
        Route::delete('/{id}', [\App\Http\Controllers\Customer\CustomerController::class, 'destroy']);
    });
    Route::group(['prefix' => 'company'], function() {
        Route::get('/', [\App\Http\Controllers\Company\CompanyController::class, 'index']);
        Route::post('/', [\App\Http\Controllers\Company\CompanyController::class, 'store']);
        Route::get('/{id}', [\App\Http\Controllers\Company\CompanyController::class, 'show']);
        Route::put('/{id}', [\App\Http\Controllers\Company\CompanyController::class, 'update']);
        Route::delete('/{id}', [\App\Http\Controllers\Company\CompanyController::class, 'destroy']);
    });
    Route::group(['prefix' => 'rider'], function() {
        Route::get('/', [\App\Http\Controllers\Rider\RiderController::class, 'index']);
        Route::post('/', [\App\Http\Controllers\Rider\RiderController::class, 'store']);
        Route::get('/{id}', [\App\Http\Controllers\Rider\RiderController::class, 'show']);
        Route::put('/{id}', [\App\Http\Controllers\Rider\RiderController::class, 'update']);
        Route::delete('/{id}', [\App\Http\Controllers\Rider\RiderController::class, 'destroy']);
    });
});
