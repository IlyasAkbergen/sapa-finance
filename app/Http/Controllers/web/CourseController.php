<?php

namespace App\Http\Controllers\web;

use App\Enums\ReferralLevelEnum;
use App\Http\Resources\MyCourseResource;
use App\Models\Course;
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
            'courses' => MyCourseResource::collection($courses)
                ->resolve()
        ]);
    }

    public function my()
    {
        $courses = $this->courseService->ofUser(Auth::user());
        return Inertia::render('Courses/MyCourses', [
            'courses' => MyCourseResource::collection($courses)
                ->resolve()
        ]);
    }

    public function show($id)
    {
        $course = $this->courseService->findWith($id, [
            'auth_user_pivot',
            'lessons.auth_user_homework'
        ]);

        if (!empty($course)) {
            return Inertia::render('Courses/CourseDetail', [
                'course' => MyCourseResource::make($course)->resolve()
            ]);
        } else {
            return redirect()->route('courses.index');
        }

    }

    public function getStarterCourseAgent(){
        $course = Course::where('tag', Course::START_COURSE_TAG)->first();

        if (empty($course)) {
            if (Auth::user()->referral_level_id < ReferralLevelEnum::Agent
                || empty(Auth::user()->referral_level_id)
            ) {
                Auth::user()->update([
                    'referral_level_id' => ReferralLevelEnum::Agent
                ]);
            }
            return redirect()->route('courses.index');
        }

        return Inertia::render('Courses/CourseDetail', [
            'course' => MyCourseResource::make($course)->resolve()
        ]);
    }
}
