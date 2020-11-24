<?php


namespace App\Services;


use App\Models\Lesson;

class LessonServiceImpl extends BaseServiceImpl implements LessonService
{
    public function __construct(Lesson $model)
    {
        parent::__construct($model);
    }
}