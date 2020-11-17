<?php


namespace App\Traits;


use App\Models\Purchase;

trait HasPurchase
{
    public function purchase()
    {
        return $this->morphMany(Purchase::class, 'model');
    }
}