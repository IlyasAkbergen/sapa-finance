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
        $result = [];
        dd($model);
        foreach ($model->all_referrers as $referrer) {
            $result[] = $referrer;

            dd($referrer);
            if ($referrer->all_referrers) {
                $result = array_merge($result, self::flat_descendants($referrer));
            }
        }
        return $result;
    }
}