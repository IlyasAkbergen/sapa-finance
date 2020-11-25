<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseRequest;
use App\Services\CourseService;

class CourseController extends WebBaseController
{
    private $courseService;

    public function __construct(CourseService $courseService)
    {
        $this->courseService = $courseService;
    }

    public function index()
    {
        $courses = $this->courseService->all();

        // todo render Inertia
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
