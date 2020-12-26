<?php

namespace App\Http\Controllers\web;

use App\Events\HomeworkRated;
use App\Models\Homework;
use App\Models\Lesson;
use App\Services\HomeworkService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class HomeworkController extends WebBaseController
{
    private $homeworkService;

    public function __construct(HomeworkService $homeworkService)
    {
        $this->homeworkService = $homeworkService;
    }

    public function index(Request $request)
    {
        $data = Homework::query()
            ->with([
                'user', 'lesson', 'attachments'
            ])
            ->whereHas('user', function ($q) {
                return $q->where('referrer_id', Auth::user()->id);
            })
            ->paginate(10);

        return Inertia::render('Homework/Index', [
            'data' => $data
        ]);
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
                    ['user_id' => Auth::user()->id]
                )
            );

            $attachment = $this->homeworkService->saveAttachment(
                $homework->id,
                $request->file('file')
            );

            DB::commit();

            if ($homework->id == $attachment->model_id) {
                return $this->responseSuccess(
                    'Домашняя работа сохранена.',
                    $homework
                );
            } else {
                return $this->responseFail(
                    'Что-то пошло не так.',
                    $homework
                );
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->responseFail('Не удалось сохранить.');
        }
    }

    // todo add middleware to rate
    public function rate(Request $request)
    {
        $request->validate([
            'homework_id' => ['required', 'exists:' . Homework::class . ',id'],
            'score' => ['required', 'integer', 'min:0', 'max:100'],
            'status' => ['required', 'integer']
        ]);

        $homework = $this->homeworkService->rate(
            $request->input('homework_id'),
            $request->input('score'),
            $request->input('status')
        );

        if (empty($homework->id)) {
            return $this->responseFail('Не удалось сохранить оценку.');
        } else {
            event(new HomeworkRated($homework));
            return redirect()->route('homeworks.index');
        }
    }
}
