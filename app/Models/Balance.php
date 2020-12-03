<?php

namespace App\Models;

use App\Events\BalanceUpdated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    use HasFactory;

    protected $fillable = ['sum', 'direct_points', 'team_points'];

    protected $dispatchesEvents = [
        'updated' => BalanceUpdated::class
    ];

    public function incomes()
    {
        $this->hasMany(BalanceOperation::class, 'target_balance_id')
            ->committed();
    }
}
