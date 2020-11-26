<?php


namespace App\Helpers;


class Helper
{
    public static function flat_all_referrals($model)
    {
        $result = collect();

        if (!empty($model->all_referrals)) {
            foreach ($model->all_referrals as $referral) {
                $result->add($referral);

                if (!empty($referral->all_referrals)) {
                    $result = $result->merge(self::flat_all_referrals($referral));
                }
            }
        }

        return $result;
    }

    public static function flat_all_referrers($model)
    {
        $result = collect();

        if (!empty($model->referrer_recursive)) {
            $referrer = $model->referrer_recursive;
            $result->add($referrer);

            if ($referrer->referrer_recursive) {
                $result = $result->merge(self::flat_all_referrers($referrer));
            }
        }

        return $result;
    }
}