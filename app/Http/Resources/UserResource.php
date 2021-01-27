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
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'iin' => $this->iin,
            'profile_photo_url' => $this->profile_photo_url,
            'profile_photo_path' => $this->profile_photo_path,
            'referral_level_id' => $this->referral_level_id,
            'next_level_progress' => $this->next_level_progress,
            'referral_level' => $this->whenLoaded(
                'referral_level',
                $this->referral_level
            ),
            'balance' => $this->whenLoaded(
                'balance',
                $this->balance
            ),
            'role_id' => $this->role_id,
            'role' => $this->whenLoaded(
                'role',
                $this->role
            ),
            'referrer' => $this->relationLoaded('referrer')
                ? UserResource::make(data_get($this, 'referrer'))
                : null,
            'referrer_id' => data_get($this, 'referrer_id'),
            'direct_points' => $this->directPoints,
            'team_points' => $this->teamPoints,
            'sales' => $this->when(
                $this->relationLoaded('sales'),
                $this->sales
            ),
            'email_verified' => !empty(data_get($this, 'email_verified_at'))
        ];
    }
}
