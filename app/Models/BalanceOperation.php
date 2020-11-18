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

    protected $fillable = [
        'target_balance_id', 'purchase_id', 'sum', 'reward_id',
        'direct_points', 'team_points', 'committed'
    ];

    public function reward()
    {
        return $this->belongsTo(Reward::class);
    }
}
