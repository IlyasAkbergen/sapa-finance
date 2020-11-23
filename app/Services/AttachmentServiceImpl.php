<?php


namespace App\Services;


use App\Models\Attachment;

class AttachmentServiceImpl extends BaseServiceImpl implements AttachmentService
{
    public function __construct(Attachment $model)
    {
        parent::__construct($model);
    }
}