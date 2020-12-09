<?php


namespace App\Services;

use App\Models\Briefcase;
use App\Models\BriefcaseType;
use App\Models\User;

interface BriefcaseService
{
    /**
     * @param Briefcase $briefcase
     * @param array $ids user ids to be attached
     */
    public function attachToUsers($briefcase, array $ids);

    /**
     * @param Briefcase $briefcase
     * @param array $ids user ids to be attached
     */
    public function detachFromUsers($briefcase, array $ids);

    /**
     * @param array $attributes
     * @return BriefcaseType
     */
    public function createType(array $attributes): BriefcaseType;

    function ofUser(User $user);
}