<?php

namespace App\Http\Controllers\web;

use App\Http\Requests\ScoreHomeworkRequest;
use App\Http\Requests\SubmitHomeworkRequest;
use App\Http\Resources\MyLessonResource;
use App\Models\Homework;
use App\Models\Lesson;
use App\Services\AttachmentService;
use App\Services\CourseService;
use App\Services\LessonService;
use Inertia\Inertia;

class LessonController extends WebBaseController
{
    private $lessonService;
    private $courseService;
    private $attachmentService;

    public function __construct(
        LessonService $lessonService,
        AttachmentService $attachmentService,
        CourseService $courseService
    )
    {
        $this->attachmentService = $attachmentService;
        $this->lessonService = $lessonService;
        $this->courseService = $courseService;
    }

    public function show($id)
    {
        $lesson = $this->lessonService->findWith($id, ['auth_user_homework']);

        if (!empty($lesson)) {
            return Inertia::render('Lessons/LessonDetail', [
                'lesson' => MyLessonResource::make($lesson)->resolve()
            ]);
        } else {
            return redirect()->route('my-courses');
        }
    }

    public function next($course_id)
    {
        $course = $this->courseService
            ->findWith($course_id, ['auth_user_pivot']);

        if (empty($course)
            || empty($course->auth_user_pivot)
            || !$course->auth_user_pivot->paid) {
            return redirect()->route('my-courses');
        }

        $lesson = Lesson::with(['auth_user_homework'])
            ->where('course_id', $course_id)
            ->whereDoesntHave('auth_user_homework')
            ->get();

        return Inertia::render('Lessons/LessonDetail', [
            'lesson' => MyLessonResource::make($lesson)->resolve()
        ]);
    }

    public function submitHomework(SubmitHomeworkRequest $request)
    {
        $homework = Homework::create([
            'lesson_id' => $request->input('lesson_id'),
            'user_id' => $request->user()->id
        ]);

        if (!empty($homework)) {
            $this->attachmentService->move($request->uuid, $homework->id);
            return redirect()
                ->route('lessons.show', $homework->lesson_id);
        } else {
            return $this->responseFail('failed submitting homework');
        }
    }

    public function scoreHomework(ScoreHomeworkRequest $request)
    {
        $homework = Homework::findOrFail($request->input('homework_id'));

        if (!empty($homework)) {
            $homework->update([
                'score' => $request->input('score')
            ]);

            return redirect()
                ->route('lessons.show', $homework->lesson_id);
        } else {
            return $this->responseFail('failed submitting homework');
        }
    }
}
