<?php

namespace App\Models;

use App\Events\BalanceUpdated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    use HasFactory;

    protected $dispatchesEvents = [
        'updated' => BalanceUpdated::class
    ];
}
