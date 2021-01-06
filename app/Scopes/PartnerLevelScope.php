<?php


namespace App\Scopes;


use App\Models\Role;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class PartnerLevelScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $builder->where(
            'role_id',
            Role::ROLE_PARTNER
        );
    }
}
