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

        $paid_sum = $payments
            ? $payments->sum('sum')
            : 0;

        return [
            'contract_number' => $this->contract_number,
            'status' => $this->status,
            'sum' => $this->sum,
            'profit' => $this->profit,
            'duration' => $this->duration,
            'monthly_payment' => data_get($this, 'monthly_payment'),
            'briefcase' => $this->whenLoaded(
                'briefcase',
                BriefcaseResource::make(data_get($this, 'briefcase'))->resolve()
            ),
            'user' => $this->whenLoaded(
                'user',
                UserResource::make(data_get($this, 'user'))->resolve()
            ),
            'paid_sum' => $paid_sum,
            'rest_sum' => $this->sum - $paid_sum
        ];
    }
}
