<?php

namespace App\Events;

use App\Models\BalanceOperation;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BalanceOperationCreated
{
    use Dispatchable, SerializesModels;

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
