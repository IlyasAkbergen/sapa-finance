<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BriefcaseResource extends JsonResource
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
            'description' => $this->description,
            'type_id' => $this->type_id,
            'image_path' => $this->image_path,
            'type_name' => $this->whenLoaded(
                'type',
                $this->type->title
            ),
        ];
    }
}
