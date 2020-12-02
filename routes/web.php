<?php

use App\Http\Controllers\web\PayoutController;
use App\Http\Controllers\web\PurchaseController;
use App\Http\Controllers\web\ReferralController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia\Inertia::render('Dashboard');
})->name('dashboard');

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::resource(
        '/articles',
        \App\Http\Controllers\ArticleController::class
    );

    Route::resource(
        'purchases',
        \App\Http\Controllers\web\PurchaseController::class
    );


    Route::resource(
        'payouts',
        PayoutController::class
    );

    Route::post(
        '/pay/success',
        [PurchaseController::class, 'my']
    );

    Route::get('/my-purchases', [PurchaseController::class, 'my']);

    Route::post('/payout/success', function () {
        return redirect('balance');
    });

    Route::get('/my-referrals', [ReferralController::class, 'myReferrals']);
});
