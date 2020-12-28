<?php

namespace App\Events;

use App\Models\BalanceOperation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BalanceOperationCreated implements ShouldQueue
{
    use Dispatchable, Queueable, SerializesModels;

    public $operation;

    /**
     * Create a new event instance.
     *
     * @param BalanceOperation $operation
     */
    public function __construct(BalanceOperation $operation)
    {
        $this->operation = $operation;
    }
}
