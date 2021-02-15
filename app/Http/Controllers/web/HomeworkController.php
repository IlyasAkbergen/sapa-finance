<?php

namespace App\Http\Controllers\web;

use App\Events\HomeworkCreated;
use App\Events\HomeworkRated;
use App\Models\Homework;
use App\Models\Lesson;
use App\Models\Message;
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
        $this->middleware('admin')->only(['index']);
    }

    public function index(Request $request)
    {
        $data = Homework::query()
            ->with([
                'user', 'lesson', 'attachments'
            ])
            ->paginate(10);

        return Inertia::render('Homework/Index', [
            'data' => $data
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'lesson_id' => ['required', 'exists:' . Lesson::class . ',id'],
            'content' => ['required_without:file'],
            'file' => [
                'required_without:content',
                'file',
                'mimes:pdf,doc,docx,txt,png,jpg,jpeg,zip'
            ]
        ]);

        DB::beginTransaction();

        try {
            $homework = $this->homeworkService->updateOrCreate(
                [
                    'lesson_id' => data_get($request, 'lesson_id'),
                    'user_id' => Auth::user()->id
                ], [
                    'content' => data_get($request, 'content')
                ]
            );

            if ($request->has('file')) {
                $this->homeworkService->saveAttachment(
                    $homework->id,
                    $request->file('file')
                );
            }

            DB::commit();

            event(new HomeworkCreated($homework));

            return redirect()
                ->route('lessons.show', $homework->lesson_id)
                ->with([
                    'message' => 'Ответ на ДЗ сохранен.',
                ]);
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
            $lesson = Lesson::find(data_get($homework, 'lesson_id'));
            $message = Message::create([
                'title' => 'ДЗ проверено.',
                'content' => 'Админ поставил оценку на ДЗ урока: "'
                    . data_get($lesson, 'title') . '"',
                'url' => route('lessons.show', data_get($homework, 'lesson_id')),
                'is_public' => false
            ]);

            $message->users()->attach(data_get($homework, 'user_id'));
            return redirect()->route('homeworks.index');
        }
    }
}
