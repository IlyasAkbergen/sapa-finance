<?php


namespace App\Challenges;


use App\Challenges\Contracts\Challengable;
use App\Challenges\Contracts\Challenge;
use App\Models\Course;
use App\Models\UserCourse;

class BoughtStartCourse implements Challenge
{
    /**
     * @inheritDoc
     */
    static function check(Challengable $challengable): bool
    {
        return UserCourse::where('user_id', $challengable->id)
            ->where('course_id', Course::START_COURSE_ID)
            ->exists();
    }
}