<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AuthUserResource extends JsonResource
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
            'balance' => $this->whenLoaded(
                'balance',
                BalanceResource::make($this->balance)
            ),
            'root_referrer_id' => $this->root_referrer_id,
            'referrer_id' => $this->referrer_id,
            'referrer' => $this->whenLoaded(
                'referrer',
                UserResource::make($this->referrer)
            ),
            'profile_photo_url' => $this->profile_photo_url,
            'referral_level_id' => $this->referral_level_id,
            'referral_level' => $this->whenLoaded(
                'referral_level',
                $this->referral_level
            )
        ];
    }
}
