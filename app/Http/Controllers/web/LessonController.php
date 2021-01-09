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
use Illuminate\Support\Facades\Auth;
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
        $lesson = $this->lessonService->findWith($id, [
            'course.auth_user_pivot',
            'course.lessons.auth_user_homework',
            'auth_user_homework'
        ]);

        if (empty($lesson->course)
            || empty($lesson->course->auth_user_pivot)
            || !$lesson->course->auth_user_pivot->paid) {
            return redirect()->route('my-courses');
        }

        $is_first_lesson = !$lesson->course->lessons->some(function ($item) {
            return !empty($item->auth_user_homework);
        });

        if (empty($lesson->auth_user_homework)
                && $is_first_lesson
        ) {
            $lesson->homeworks()->create([
                'user_id' => Auth::user()->id
            ]);

            $lesson->loadMissing('auth_user_homework');
        }

        if (!empty($lesson)) {
            return Inertia::render('Lessons/LessonDetail', [
                'lesson' => MyLessonResource::make($lesson)->resolve()
            ]);
        } else {
            return redirect()->route('my-courses');
        }
    }

    public function next($course_id, $lesson_id)
    {
        $currentLesson = $this->lessonService->findWith($lesson_id, [
            'course.lessons',
            'auth_user_homework',
            'course.auth_user_pivot',
        ]);

        $course = $currentLesson->course;

        if (empty($course)
            || empty($course->auth_user_pivot)
            || !$course->auth_user_pivot->paid) {
            return redirect()->route('my-courses');
        }

        $lesson = Lesson::with('auth_user_homework')
            ->where('course_id', $course_id)
            ->where('order', '>', $currentLesson->order)
            ->orderBy('order')
            ->first();

        $with_feedback = data_get(
            $course,
            'auth_user_pivot.with_feedback'
        );

        if (!$with_feedback
            && !empty($currentLesson->auth_user_homework)
            && (
                !$currentLesson->auth_user_homework->accepted
                || $currentLesson->score < 100
            )
        ) {
            $currentLesson->auth_user_homework->update([
                'status' => Homework::STATUS_ACCEPTED,
                'score' => 100
            ]);
        }

        if (
            empty($lesson->auth_user_homework) && (
                !$with_feedback || (
                    $with_feedback
                        && $currentLesson
                            ->auth_user_homework
                            ->accepted
                )
            )
        ) {
            $lesson->homeworks()->create([
                'user_id' => Auth::user()->id
            ]);

            $lesson->load('auth_user_homework');
        }

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
