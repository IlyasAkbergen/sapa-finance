<?php

namespace App\Events;

use App\Models\Reward;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RewardCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $reward;

    /**
     * Create a new event instance.
     *
     * @param Reward $reward
     */
    public function __construct(Reward $reward)
    {
        $this->reward = $reward;
    }
}
