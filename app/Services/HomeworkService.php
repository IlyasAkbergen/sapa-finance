<?php


namespace App\Services;


use App\Models\Homework;

interface HomeworkService
{
    /**
     * @param int $homework_id
     * @param int $score
     * @param int $status
     * @return
     */
    public function rate($homework_id, $score, $status = Homework::STATUS_ACCEPTED);

    /**
     * @param $homework_id
     * @param $file
     */
    public function saveAttachment($homework_id, $file);
}