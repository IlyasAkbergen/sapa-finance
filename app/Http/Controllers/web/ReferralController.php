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
    )
    {
        $this->userService = $userService;
    }

    public function myReferrals()
    {
        $referrals = $this->userService->findWith(Auth::user()->id, ['all_referrals']);

        return Inertia::render('Profile/Referrals', [
            'referrals' => $referrals->all_referrals
        ]);
    }

    public function myRewards()
    {
        // todo implement rewards
    }
}
