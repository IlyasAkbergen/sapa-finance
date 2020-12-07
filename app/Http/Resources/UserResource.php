<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name' => $this->iin,
            'phone' => $this->phone,
            'email' => $this->email,
            'profile_photo_url' => $this->profile_photo_url,
            'referral_level_id' => $this->referral_level_id,
            'referral_level' => $this->whenLoaded(
                'referral_level',
                $this->referral_level
            )
        ];
    }
}
