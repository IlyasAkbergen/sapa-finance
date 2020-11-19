<?php

namespace App\Events;

use App\Models\Purchase;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PurchaseMade implements ShouldQueue
{
    use Dispatchable, SerializesModels;

    public $purchase;

    /**
     * Create a new event instance.
     *
     * @param Purchase $purchase
     */
    public function __construct(Purchase $purchase)
    {
        $this->purchase = $purchase;
    }
}
