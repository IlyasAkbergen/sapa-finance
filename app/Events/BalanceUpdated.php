<?php

namespace App\Events;

use App\Models\Balance;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BalanceUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $balance;

    /**
     * Create a new event instance.
     *
     * @param Balance $balance
     */
    public function __construct(Balance $balance)
    {
        $this->balance = $balance;
    }
}
