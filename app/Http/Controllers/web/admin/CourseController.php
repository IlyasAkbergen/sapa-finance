<?php

namespace App\Http\Controllers\web\admin;

use App\Http\Controllers\web\WebBaseController;
use App\Http\Requests\CourseRequest;
use App\Http\Resources\MyCourseResource;
use App\Models\Course;
use App\Services\CourseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CourseController extends WebBaseController
{
    private $courseService;

    public function __construct(CourseService $courseService)
    {
        $this->courseService = $courseService;
    }

    public function index(Request $request)
    {
        $data = Course::where('title', 'like', "%$request->search_key%")
            ->paginate(10);

        return Inertia::render('Courses/Crud/Index', [
            'data' => $data
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

    public function edit($id)
    {
        $course = $this->courseService->findWith($id, ['lessons']);

        return Inertia::render('Courses/Crud/Edit', [
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
