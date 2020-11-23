<?php


namespace App\Services;


use App\Models\Homework;

class HomeworkServiceImpl extends BaseServiceImpl implements HomeworkService
{
    public function __construct(Homework $model)
    {
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
        // TODO: Implement saveAttachment() method.
    }
}