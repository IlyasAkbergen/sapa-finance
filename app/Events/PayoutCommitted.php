<?php

namespace App\Events;

use App\Models\Payout;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PayoutCommitted implements ShouldQueue
{
    use Dispatchable, Queueable, SerializesModels;

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
