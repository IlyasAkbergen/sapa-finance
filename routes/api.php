<?php

use App\Helpers\Helper;
use App\Models\User;
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

Route::get('test', function () {
//   \App\Models\Purchase::create([
//        'user_id' => 5,
//        'sum' => 12000,
//        'purchasable_id' => 5,
//        'purchasable_type' => \App\Models\Course::class
//   ]);
    $all_referrers = User::with('all_referrers')->find(6);
    dd(Helper::flat_all_referrers($all_referrers));
//        ->first()->all_referrers->flattenTree('all_referrers'));

});
