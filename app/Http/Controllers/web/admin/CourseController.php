<?php

namespace App\Http\Controllers\web\admin;

use App\Http\Controllers\web\WebBaseController;
use App\Http\Requests\CourseRequest;
use App\Http\Resources\MyCourseResource;
use App\Models\Course;
use App\Services\AttachmentService;
use App\Services\CourseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CourseController extends WebBaseController
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
        $data = $request->all();

        $filepath = $this->attachmentService->storeFile(
            $request->file('image'), 'Course'
        );

        $data['image_path'] = $filepath;

        $course = $this->courseService->create($data);

        if (!empty($course)) {
            return redirect()
                ->route('courses-crud.edit', $course->id);
        } else {
            return $this->responseFail('failed saving');
        }
    }

    public function create()
    {
        return Inertia::render('Courses/Crud/Add');
    }

    public function edit($id)
    {
        $course = $this->courseService->findWith($id, ['lessons']);

        if (!empty($course)) {
            return Inertia::render('Courses/Crud/Edit', [
                'course' => $course
            ]);
        } else {
            return redirect()->route('courses-crud.index');
        }
    }

    public function update(CourseRequest $request, $id)
    {
        $data = $request->all();

        if ($request->has('image')) {
            $filepath = $this->attachmentService->storeFile(
                $request->file('image'),
                'Course'
            );

            $data['image_path'] = $filepath;
        }

        $course = $this->courseService->update(
            $request->input('id'),
            $data
        );

        if (!empty($course)) {
            return redirect()
                ->route('courses-crud.index');
        } else {
            return $this->responseFail('Не удалось обновить курс');
        }
    }

    public function destroy($id)
    {
        $deleted = $this->courseService->delete($id);

        if ($deleted) {
            return redirect()->route('courses-crud.index');
        } else {
            return $this->responseFail('Не удалось удалить');
        }
    }

    public function stats()
    {
        $courses = $this->courseService->allWith([
            'purchases' => function ($q) {
                return $q->payed();
            }
        ]);

        return Inertia::render('Courses/Stats', [
            'courses' => $courses
        ]);
    }

    public function uploadImage(Request $request)
    {

    }

    public function uploadAttachments(Request $request)
    {

    }
}
