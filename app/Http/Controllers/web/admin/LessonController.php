<?php

namespace App\Http\Controllers\web\admin;

use App\Http\Controllers\web\WebBaseController;
use App\Http\Requests\LessonFormRequest;
use App\Services\AttachmentService;
use App\Services\LessonService;

class LessonController extends WebBaseController
{
    private $lessonService;
    private $attachmentService;

    public function __construct(
        LessonService $lessonService,
        AttachmentService $attachmentService
    )
    {
        $this->lessonService = $lessonService;
        $this->attachmentService = $attachmentService;
    }

    public function store(LessonFormRequest $request)
    {
        $lesson = $this->lessonService->create(
            $request->only([
                'title',
                'course_id',
                'content',
                'video_url',
                'order',
                'homework_content'
            ])
        );

        if (!empty($lesson)) {
            $this->attachmentService->move($request->uuid, $lesson->id);

            return $this->responseSuccess('Урок сохранен.');
        } else {
            return $this->responseFail('failed saving lesson');
        }
    }

    public function update(LessonFormRequest $request, $id)
    {
        $lesson = $this->lessonService->update($id, $request->only([
            'title',
            'content',
            'video_url',
            'homework_content'
        ]));

        if (!empty($lesson)) {
            return $this->responseSuccess('Урок сохранен.');
        } else {
            return $this->responseFail('failed updating lesson');
        }
    }

    public function destroy($id)
    {
        return $this->lessonService->delete($id)
            ? $this->responseSuccess('ok')
            : $this->responseFail('failed deleting lesson');
    }
}
