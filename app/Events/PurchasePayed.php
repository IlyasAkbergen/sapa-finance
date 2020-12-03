<?php

namespace App\Events;

use App\Models\Purchase;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PurchasePayed implements ShouldQueue
{
    use Dispatchable, SerializesModels, Queueable;

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
