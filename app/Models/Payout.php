<?php

namespace App\Models;

use App\Events\PayoutCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payout extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'sum', 'committed'
    ];

    protected $dispatchesEvents = [
        'created' => PayoutCreated::class
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
