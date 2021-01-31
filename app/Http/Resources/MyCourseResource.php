<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MyCourseResource extends JsonResource
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
            'short_description' => $this->short_description,
            'description' => $this->description,
            'progress' => $this->my_progress,
            'bought' => !empty($this->auth_user_pivot)
                && $this->auth_user_pivot->paid,
            'lessons' => $this->when(
                $this->relationLoaded('lessons'),
                MyLessonResource::collection($this->lessons)
                    ->resolve()
            ),
            'price_without_feedback' => $this->price_without_feedback,
            'price_with_feedback' => $this->price_with_feedback,
            'image_path' => $this->image_path,
            'video_url' => $this->video_url
        ];
    }
}
