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

    function allCanBuy(User $user)
    {
        $courses = Course::whereDoesntHave('users_pivot', function ($query) use ($user) {
            return $query->where('user_id', $user->id);
        })->get();

        return $courses;
    }
}