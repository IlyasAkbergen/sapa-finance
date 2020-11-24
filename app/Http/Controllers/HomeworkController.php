<?php

namespace App\Http\Controllers;

use App\Events\HomeworkRated;
use App\Models\Homework;
use App\Models\Lesson;
use App\Services\HomeworkService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class HomeworkController extends Controller
{
    private $homeworkService;

    public function __construct(HomeworkService $homeworkService)
    {
        $this->homeworkService = $homeworkService;
    }

    public function store(Request $request)
    {
        $request->validate([
            'lesson_id' => ['required', 'exists:' . Lesson::class . ',id'],
            'file' => ['required', 'file', 'mimes:pdf,doc,docx,txt,png,jpg,jpeg,zip']
        ]);

        DB::beginTransaction();

        try {
            $homework = $this->homeworkService->create(
                array_merge(
                    $request->only(['lesson_id']),
                    [ 'user_id' => Auth::user()->id ]
                )
            );

            $attachment = $this->homeworkService->saveAttachment(
                $homework->id,
                $request->file('file')
            );

            DB::commit();

            if ($homework->id == $attachment->model_id) {
                dd('saved');
                return $this->responseSuccess(
                    'Домашняя работа сохранена.',
                    $homework
                );
            } else {
                dd('failed');
                return $this->responseFail(
                    'Что-то пошло не так.',
                    $homework
                );
            }
        } catch (\Exception $e) {
            DB::rollBack();
            dd('catch failed: '. $e->getMessage());
            return $this->responseFail('Не удалось сохранить.');
        }
    }

    // todo add middleware to rate
    public function rate(Request $request)
    {
        $request->validate([
            'homework_id' => ['required', 'exists:' . Homework::class . ',id'],
            'score' => ['required', 'integer', 'min:0', 'max:100']
        ]);

        $homework = $this->homeworkService->rate(
            $request->input('homework_id'),
            $request->input('score')
        );

        event(new HomeworkRated($homework));

        if (empty($homework->id)) {
            return $this->responseFail('Не удалось сохранить оценку.');
        } else {
            return $this->responseSuccess('Оценка сохранена.', $homework);
        }
    }
}
