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

    Route::get('/my-purchases', [PurchaseController::class, 'my']);

    Route::get('/my-referrals', [ReferralController::class, 'myReferrals']);
});

Route::get('/test-payout/{sum}', [PayoutController::class, 'store']);

Route::get('/test/{id}', function ($id) {
    $gate = new \App\Services\Gates\PayboxGate();
    $gate->setOrder(\App\Models\Purchase::find($id));
    $gate->redirectToPaymentPage();
});