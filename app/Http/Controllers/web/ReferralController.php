<?php

namespace App\Http\Controllers\web;

use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class ReferralController extends WebBaseController
{
    private $userService;

    public function __construct(
        UserService $userService
    ){
        $this->userService = $userService;
    }

    public function myReferrals()
    {
//        DB::connection()->enableQueryLog();
        $referrals = $this->userService->allReferralsOf(Auth::user()->id);
//        dd(DB::getQueryLog());
//        dd($referrals);

        return Inertia::render('Profile/Referrals', [
            'referrals' => $referrals
        ]);
    }

    public function myRewards()
    {
        // todo implement rewards
    }
}
