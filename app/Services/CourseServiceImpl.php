<?php


namespace App\Services;


use App\Models\Course;

class CourseServiceImpl extends BaseServiceImpl implements CourseService
{
    public function __construct(Course $model)
    {
        parent::__construct($model);
    }
}