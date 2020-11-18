<?php

namespace App\Models;

use App\Events\PurchaseMade;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    static $DIRECT_POINTS_PER_PURCHASE = 10;

    protected $fillable = [
        'user_id', 'sum', 'purchasable_id', 'purchasable_type'
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
        'saved' => PurchaseMade::class
    ];
}
