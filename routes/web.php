<?php

use App\Http\Controllers\BriefcaseController;
use App\Http\Controllers\web\CourseController;
use App\Http\Controllers\web\NotificationController;
use App\Http\Controllers\web\PayoutController;
use App\Http\Controllers\web\PurchaseController;
use App\Http\Controllers\web\ReferralController;
use App\Http\Controllers\web\SaleController;
use App\Http\Controllers\web\SupportController;
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

Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
    Route::resource('courses', CourseController::class);

    Route::get(
        'my-courses',
        [CourseController::class, 'my']
    )->name('my-courses');

    Route::resource('briefcases', BriefcaseController::class);

    Route::get('/my-briefcases', [BriefcaseController::class, 'my'])
        ->name('my-briefcases');

    Route::resource(
        '/articles',
        \App\Http\Controllers\ArticleController::class
    );

    Route::resource(
        'purchases',
        PurchaseController::class
    );

    Route::resource(
        'payouts',
        PayoutController::class
    );

    Route::get(
        '/pay/success',
        function () {
            return redirect()->route('my-purchases');
        }
    );

    Route::get(
        '/my-purchases',
        [PurchaseController::class, 'my']
    )->name('my-purchases');

    Route::post('/payout/success', function () {
        return redirect('balance');
    });

    Route::get('/my-referrals', [ReferralController::class, 'myReferrals']);

    Route::resource('sales', SaleController::class);

    Route::resource('support', SupportController::class);

    Route::resource('notifications', NotificationController::class);

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
