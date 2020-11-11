<?php


namespace App\Traits;


use App\Models\ReferralLevel;
use App\Models\User;

trait HasReferrals
{
    public function referrals()
    {
        return $this->hasMany(User::class, 'referrer_id');
    }

    public function allReferrals()
    {
        return $this->referrals()
            ->with('allReferrals');
    }

    public function referralLevel()
    {
        return $this->belongsTo(
            ReferralLevel::class,
            'referral_level_id'
        );
    }
}