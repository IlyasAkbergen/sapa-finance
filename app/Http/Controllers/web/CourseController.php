<?php

namespace App\Http\Controllers\web;

use App\Http\Requests\CourseRequest;
use App\Http\Resources\MyCourseResource;
use App\Services\CourseService;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CourseController extends WebBaseController
{
    private $courseService;

    public function __construct(CourseService $courseService)
    {
        $this->courseService = $courseService;
    }

    public function index()
    {
        $courses = $this->courseService->allCanBuy(Auth::user());
        return Inertia::render('Courses/Courses', [
            'courses' => $courses
        ]);
    }

    public function my()
    {
        $courses = $this->courseService->ofUser(Auth::user());
        return Inertia::render('Courses/MyCourses', [
            'courses' => MyCourseResource::collection($courses)->resolve()
        ]);
    }

    public function show($id)
    {
        $course = $this->courseService->find($id);

        if (!empty($course)) {
            return Inertia::render('Courses/CourseDetail', [
                'course' => $course
            ]);
        } else {
            return redirect()->route('courses.index');
        }

    }
}
