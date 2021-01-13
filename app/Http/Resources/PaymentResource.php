<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
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
            'purchasable' => PurchasableResource::make(
                                $this->payable->purchasable
                            )->resolve(),
            'updated_at' => Carbon::parse($this->updated_at)
                ->format('d.m.Y H:i'),
            'paid_at' => Carbon::parse($this->paid_at)
                ->format('d.m.Y H:i'),
            'sum' => $this->sum
        ];
    }
}
