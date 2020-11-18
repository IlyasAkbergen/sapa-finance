<?php


namespace App\Helpers;


class Helper
{
    public static function flat_ancestors($model) {
        $result = [];
        if ($model->parent) {
            $result[] = $model->parent;
            $result = array_merge($result, self::flat_ancestors($model->parent));
        }
        return $result;
    }

    public static function flat_all_referrers($model) {
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