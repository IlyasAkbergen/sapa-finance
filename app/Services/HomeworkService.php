<?php


namespace App\Services;


use App\Models\Homework;

interface HomeworkService
{
    /**
     * @param int $homework_id
     * @param int $score
     * @returns Homework
     */
    public function rate($homework_id, $score);

    public function saveAttachment($homework_id, $file);
}