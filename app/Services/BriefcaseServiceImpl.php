<?php


namespace App\Services;


use App\Models\Briefcase;
use App\Models\BriefcaseType;
use App\Models\User;

class BriefcaseServiceImpl extends BaseServiceImpl implements BriefcaseService
{
    public function __construct(Briefcase $model)
    {
        parent::__construct($model);
    }

    public function attachToUsers($briefcase, array $ids)
    {
        return $briefcase->users()->attach($ids);
    }

    public function detachFromUsers($briefcase, array $ids)
    {
        return $briefcase->users()->detach($ids);
    }

    public function createType(array $attributes): BriefcaseType
    {
        return BriefcaseType::create($attributes);
    }

    function ofUser(User $user)
    {
        $user->loadMissing('briefcases.auth_user_pivot');

        return $user->briefcases;
    }
}