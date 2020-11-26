<?php

namespace App\Models;

use App\Events\PurchaseMade;
use App\Events\PurchasePayed;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    static $DIRECT_POINTS_PER_PURCHASE = 10;

    protected $fillable = [
        'user_id', 'sum', 'purchasable_id', 'purchasable_type', 'payed', 'with_feedback'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function purchasable()
    {
        return $this->morphTo();
    }

    protected $dispatchesEvents = [
        'created' => PurchaseMade::class,
        'payed' => PurchasePayed::class
    ];

    protected static function booted()
    {
        static::saved(function ($purchase) {
            if (!$purchase->wasRecentlyCreated
                && $purchase->payed
                && isset($purchase->getChanges()['payed'])
                && !$purchase->getChanges()['payed']
            ) {
                $purchase->fireModelEvent('payed', false);
            }
        });
    }
}
