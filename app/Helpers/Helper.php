<?php


namespace App\Helpers;


class Helper
{
    public static function flat_all_referrals($model, $level = 1)
    {
        $result = collect();

        if (data_get($model, 'all_referrals')) {
            foreach (data_get($model, 'all_referrals') as $referral) {
                data_set($referral, 'level', $level);
                $result->add($referral);

                if (data_get($referral, 'all_referrals')) {
                    $result = $result->merge(self::flat_all_referrals($referral, ++$level));
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
