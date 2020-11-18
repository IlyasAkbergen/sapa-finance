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

    public function root_referrer()
    {
        return $this->belongsTo(User::class, 'root_referrer_id');
    }

    public function referrals()
    {
        return $this->hasMany(User::class, 'referrer_id');
    }

    public function all_referrals()
    {
        return $this->referrals()
            ->with('all_referrals');
    }

    public function all_referrers()
    {
        return $this->referrer()
            ->with('all_referrers');
    }

    public function referralLevel()
    {
        return $this->belongsTo(
            ReferralLevel::class,
            'referral_level_id'
        );
    }
}