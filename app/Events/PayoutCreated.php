<?php

namespace App\Events;

use App\Models\Payout;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PayoutCreated implements ShouldQueue
{
    use Dispatchable, SerializesModels;

    public $payout;

    /**
     * Create a new event instance.
     *
     * @param Payout $payout
     */
    public function __construct(Payout $payout)
    {
        $this->payout = $payout;
    }
}
