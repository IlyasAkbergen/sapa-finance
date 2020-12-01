<?php

namespace App\Models;

use App\Events\PayoutCommitted;
use App\Events\PayoutCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payout extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'sum', 'committed', 'payment_id'
    ];

    protected $dispatchesEvents = [
        'created' => PayoutCreated::class,
        'committed' => PayoutCommitted::class
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function setCommitted($payment_id = null)
    {
        $this->update([
            'committed' => true,
            'payment_id' => $payment_id
        ]);

        $this->fireModelEvent('committed');
    }

    public function payments()
    {
        return $this->morphMany(Payment::class, 'payable');
    }
}
