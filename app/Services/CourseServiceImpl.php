<?php


namespace App\Services;


use App\Models\Course;
use App\Models\User;

class CourseServiceImpl extends BaseServiceImpl implements CourseService
{
    public function __construct(Course $model)
    {
        parent::__construct($model);
    }

    function ofUser(User $user)
    {
        $user->loadMissing('courses');

        return $user->courses;
    }
}