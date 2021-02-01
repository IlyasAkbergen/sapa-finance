<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PartnerResource extends JsonResource
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
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'iin' => $this->iin,
            'profile_photo_url' => $this->profile_photo_url,
            'profile_photo_path' => $this->profile_photo_path,
            'referral_level_id' => $this->referral_level_id,
            'referral_level' => $this->whenLoaded(
                'referral_level',
                $this->referral_level
            ),
            'role_id' => $this->role_id,
            'role' => $this->whenLoaded(
                'role',
                $this->role
            ),
            'referrer' => $this->whenLoaded(
                'referrer',
                UserResource::make($this->referrer)
            ),
            'bin' => $this->bin,
            'email_verified_at' => data_get($this, 'email_verified_at'),
        ];
    }
}
