<?php

namespace App\Listeners;

use App\Events\HomeworkCreated;
use App\Events\HomeworkRated;
use App\Models\UserCourse;
use Illuminate\Contracts\Queue\ShouldQueue;

class CourseEventsSubscriber implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function handleHomeworkSubmitted($event)
    {

    }

    public function handleHomeworkRated($event)
    {
        $homework = $event->homework;

        $homework->load([
            'lesson.course.lessons',
            'lesson.course.lessons.homework' => function ($q) use ($homework) {
                return $q->where('user_id', $homework->user_id);
            }
        ]);

        $alL_lessons = $homework->lesson->course->lessons;

        $passed_lessons = $alL_lessons->filter(function ($item) {
           return !empty($item->homework) && !empty($item->homework->score);
        });

        $completed = $alL_lessons->count() == $passed_lessons->count();

        $progress = $alL_lessons->count() > 0 && $passed_lessons->count() > 0
            ? $passed_lessons->count() * 100 / $alL_lessons->count()
            : 0;

        $user_course = UserCourse::where('user_id', $homework->user_id)
            ->where('course_id', $homework->lesson->course_id)
            ->first();

        if (!empty($user_course)) {
            $user_course->update([
                'progress' => $progress,
                'completed' => $completed
            ]);
        }
    }

    /**
     * Handle the event.
     *
     * @param  object  $events
     * @return void
     */
    public function subscribe($events)
    {
        $events->listen(
            HomeworkCreated::class,
            [self::class, 'handleHomeworkSubmitted']
        );

        $events->listen(
            HomeworkRated::class,
            [self::class, 'handleHomeworkRated']
        );
    }
}
