<?php


namespace App\Services;


use App\Models\Homework;

class HomeworkServiceImpl extends BaseServiceImpl implements HomeworkService
{
    private $attachmentService;

    public function __construct(Homework $model, AttachmentService $attachmentService)
    {
        $this->attachmentService = $attachmentService;
        parent::__construct($model);
    }

    public function rate($homework_id, $score)
    {
        return $this->update($homework_id, [
            'score' => $score
        ]);
    }

    public function saveAttachment($homework_id, $file)
    {
        $this->attachmentService->setDir(Homework::ATTACHMENT_MAIN_DIR);

        return $this->attachmentService->save(
            $homework_id, Homework::class, $file
        );
    }
}