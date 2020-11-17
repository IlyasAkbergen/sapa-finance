<?php

namespace App\Models;

use App\Events\BalanceOperationCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BalanceOperation extends Model
{
    use HasFactory;

    protected $dispatchesEvents = [
        'saved' => BalanceOperationCreated::class
    ];
}
