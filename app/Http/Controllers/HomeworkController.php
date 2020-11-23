<?php

namespace App\Http\Controllers;

use App\Events\HomeworkRated;
use App\Models\Homework;
use App\Models\Lesson;
use App\Services\HomeworkService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $validatedData = Validator::make($request->all(), [
            'lesson_id' => ['required', 'exists:' . Lesson::class . ', id'],
            'file' => ['required', 'file', 'mimes:pdf,doc,docx,txt,png,jpg,jpeg,zip']
        ])->validate();

        $homework = $this->homeworkService->create(array_merge($validatedData, [
            'user_id' => Auth::user()->id
        ]));

        if (empty($homework->id)) {
            return $this->responseFail('Не удалось сохранить.');
        } else {
            return $this->responseSuccess(
                'Домашняя работа сохранена.',
                $homework
            );
        }
    }

    public function rate(Request $request)
    {
        $request->validate([
            'homework_id' => ['required', 'exists:' . Homework::class . ', id'],
            'score' => ['required', 'integer', 'min:0', 'max:100']
        ]);

        $homework = $this->homeworkService->rate(
            $request->input('homework_id'),
            $request->input('score')
        );

        if (empty($homework->id)) {
            return $this->responseFail('Не удалось сохранить оценку.');
        } else {
            event(new HomeworkRated($homework));
            return $this->responseSuccess('Оценка сохранена.', $homework);
        }
    }
}
