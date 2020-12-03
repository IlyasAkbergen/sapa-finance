<?php


namespace App\Challenges;


use App\Challenges\Contracts\Challengable;
use App\Challenges\Contracts\Challenge;
use App\Enums\ReferralLevelEnum;

class Referred50FC implements Challenge
{

    /**
     * Checks if has 50 financial consultants referred
     * @inheritDoc
     */
    static function check(Challengable $challengable): bool
    {
        $all_referrals = $challengable->getAllReferrals();

        return $all_referrals->where(
                'referral_level_id',
                ReferralLevelEnum::Consultant
            )->count() >= 50;
    }
}