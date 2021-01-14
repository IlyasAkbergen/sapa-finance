<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BriefcaseUserResourse extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $briefcase = $this->relationLoaded('briefcase')
            ? BriefcaseResource::make($this->briefcase)
                ->resolve()
            : null;

        $user = $this->relationLoaded('user')
            ? UserResource::make($this->user)->resolve()
            : null;

        return [
            'id' => $this->id,
            'status' => $this->status,
            'contract_number' => $this->contract_number,
            'briefcase' => $briefcase,
            'briefcase_id' => data_get($briefcase, 'id'),
            'user' => $user,
            'user_id' => data_get($user, 'id'),
            'sum' => $this->sum,
            'profit' => $this->profit,
            'duration' => $this->duration,
            'monthly_payment' => $this->monthly_payment,
        ];
    }
}
