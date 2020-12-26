<?php


namespace App\Services;


use App\Models\Support;

class SupportServiceImpl extends BaseServiceImpl implements SupportService
{
    private $attachmentService;

    public function __construct(Support $model, AttachmentService $attachmentService)
    {
        $this->attachmentService = $attachmentService;
        parent::__construct($model);
    }

    public function saveAttachment($homework_id, $file)
    {
        $this->attachmentService->setDir(Support::ATTACHMENT_MAIN_DIR);

        return $this->attachmentService->save(
            $homework_id, Support::class, $file
        );
    }
}
