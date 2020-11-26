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

    public function setPayed()
    {
        // todo вынести в сервис
        $this->update([
            'payed' => true
        ]);

        $this->fireModelEvent('payed');
    }
}
