<?php


namespace App\Traits;


use App\Models\ReferralLevel;
use App\Models\User;

trait HasReferrals
{
    public function referrer()
    {
        return $this->belongsTo(User::class, 'referrer_id');
    }

    public function rootReferrer()
    {
        return $this->belongsTo(User::class, 'root_referrer_id');
    }

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