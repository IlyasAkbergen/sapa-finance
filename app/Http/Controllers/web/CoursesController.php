<?php

namespace App\Http\Controllers\web;

use App\Services\CourseService;
use Inertia\Inertia;

class CoursesController extends WebBaseController
{
    private $courseService;

    public function __construct(CourseService $courseService)
    {
        $this->courseService = $courseService;
    }

    public function index()
    {
        $courses = $this->courseService->all();
        return Inertia::render('Courses/Courses', [
            'courses' => $courses
        ]);
    }
}