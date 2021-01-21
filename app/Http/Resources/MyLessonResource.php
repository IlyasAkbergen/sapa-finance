<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MyLessonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'homework_content' => $this->homework_content,
            'video_url' => $this->video_url,
            'course_id' => $this->course_id,
            'attachment_path' => $this->attachment_path,
            'homework_attachment_path' => $this->homework_attachment_path,
            'user_homework' => $this->whenLoaded(
                'auth_user_homework'
            ),
            'passed' => $this->passed,
            'enabled' => $this->enabled,
            'has_next_lesson' => $this->has_next_lesson
        ];
    }
}
