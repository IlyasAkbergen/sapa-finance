<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DealResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $payments = $this->relationLoaded('purchase')
            ? data_get($this->purchase, 'payments')
            : collect([]);

        return [
            'contract_number' => $this->contract_number ?: 'Не подтвержден',
            'status' => $this->status,
            'sum' => $this->sum,
            'profit' => $this->profit,
            'duration' => $this->duration,
            'monthly_payment' => $this->duration,
            'briefcase' => $this->whenLoaded(
                'briefcase',
                BriefcaseResource::make(data_get($this, 'briefcase'))->resolve()
            ),
            'user' => $this->whenLoaded(
                'user',
                UserResource::make(data_get($this, 'user'))->resolve()
            ),
            'paid_sum' => $payments->sum('sum')
        ];
    }
}
