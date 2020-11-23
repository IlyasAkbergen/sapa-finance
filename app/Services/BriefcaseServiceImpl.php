<?php


namespace App\Services;


use App\Models\Briefcase;

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
}