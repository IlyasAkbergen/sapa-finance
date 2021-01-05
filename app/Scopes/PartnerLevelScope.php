<?php


namespace App\Scopes;


use App\Enums\ReferralLevelEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class PartnerLevelScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $builder->where(
            'referral_level_id',
            ReferralLevelEnum::Partner
        );
    }
}