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

    public function store(CourseRequest $request)
    {
        $course = $this->courseService->create($request->all());

        if (!empty($course)) {
            return $this->responseSuccess('Course saved', $course);
        } else {
            return $this->responseFail('failed saving');
        }
    }

    public function show($id)
    {
        $course = $this->courseService->find($id);

        return Inertia::render('Courses/CourseDetail', [
            'course' => $course
        ]);
    }

    public function update(CourseRequest $request)
    {
        $course = $this->courseService->update(
            $request->input('id'),
            $request->all()
        );

        if (!empty($course)) {
            return $this->responseSuccess('Course saved', $course);
        } else {
            return $this->responseFail('failed saving');
        }
    }
}
