<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
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
            'image_path' => $this->image_path,
            'video_url' => $this->video_url,
            'created_at' => Carbon::parse($this->created_at)
                ->isoFormat('DD.MM.YYYY')
        ];
    }
}
