<?php

namespace App\Models;

use App\Events\RewardCreated;
use App\Events\RewardHandled;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
    use HasFactory;

    protected $fillable = [
        'target_user_id', 'purchase_id', 'handled',
        'is_direct', 'sum', 'points'
    ];

    protected $dispatchesEvents = [
        'created' => RewardCreated::class,
        'handled' => RewardHandled::class
    ];

    public function operation()
    {
        return $this->hasOne(BalanceOperation::class);
    }

    public function awardable()
    {
        return $this->belongsTo(User::class, 'target_user_id');
    }

    public function makeHandled()
    {
        $updated = $this->update([
            'handled' => true
        ]);

        if ($updated) {
            $this->fireModelEvent('handled');
        }

        return $updated;
    }
}
