<?php


namespace App\Services;

use App\Models\Briefcase;

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
}