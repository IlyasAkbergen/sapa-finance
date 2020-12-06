<?php

use App\Http\Controllers\web\PayoutController;
use App\Http\Controllers\web\PurchaseController;
use App\Http\Controllers\web\ReferralController;
use Illuminate\Support\Facades\Route;

// controllers for front
use App\Http\Controllers\front\CoursesController;

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

Route::get('/', [CoursesController::class, 'Courses'])
    ->name('courses')
    ->middleware('auth');

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

Route::get('/test', function () {
//    $user = User::with('balance')->findOrFail(5);
//
//    if ($user->referral_level_id == ReferralLevelEnum::Partner) {
//        return;
//    }
//
//    $next_level_id = empty($user->referral_level_id)
//        ? ReferralLevelEnum::Agent
//        : $user->referral_level_id + 1;
//
//    $next_level = ReferralLevel::findOrFail($next_level_id);
//
//    $deservesLevelUp = true;
//
//    foreach ($next_level->achieve_challenges as $challenge) {
//        $deservesLevelUp = $deservesLevelUp && $challenge::check($user);
//    }
//
//    if ($deservesLevelUp) {
//        $user->updateReferralLevel($next_level_id);
//    }
});
