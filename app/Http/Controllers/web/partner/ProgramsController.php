<?php

namespace App\Http\Controllers\web\partner;

use App\Http\Controllers\Controller;
use App\Http\Resources\MyCourseResource;
use App\Services\AttachmentService;
use App\Services\CourseService;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ProgramsController extends Controller
{
    private $courseService;
    private $attachmentService;

    public function __construct(
        CourseService $courseService,
        AttachmentService $attachmentService
    )
    {
        $this->courseService = $courseService;
        $this->attachmentService = $attachmentService;
    }

    public function index()
    {
        $courses = $this->courseService->ofUser(Auth::user());
        return Inertia::render('Programs/Index', [
            'courses' => MyCourseResource::collection($courses)->resolve()
        ]);
    }

    public function edit($id)
    {
        $course = $this->courseService->findWith($id, ['lessons']);

        if (!empty($course)) {
            return Inertia::render('Programs/Crud/Edit', [
                'course' => $course
            ]);
        } else {
            return redirect()->route('programs-crud.index');
        }
    }
}
