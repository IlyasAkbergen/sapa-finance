<?php

use App\Http\Controllers\api\PayoutController;
use App\Http\Controllers\api\PurchaseController;
use App\Http\Controllers\web\HomeworkController;
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

Route::post(
    '/pay/result',
    [PurchaseController::class, 'makePayed']
);

Route::post(
    '/payout/result',
    [PayoutController::class, 'makeCommitted']
);

Route::apiResource('homeworks', HomeworkController::class);

Route::post('homework/rate', [HomeworkController::class, 'rate']);

Route::group(['middleware' => 'auth:sanctum'], function () {
});
