<?php

namespace App\Models;

use App\Interfaces\WithPurchase;
use App\Traits\Awardable;
use App\Traits\HasUsers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Briefcase extends Model implements WithPurchase
{
    use HasFactory;
    use Awardable;
    use HasUsers;

    protected $fillable = [
        'title', 'description', 'type_id', 'sum', 'profit', 'duration',
        'monthly_payment', 'direct_fee', 'awardable'
    ];

    function purchases()
    {
        return $this->morphMany(Purchase::class, 'purchasable');
    }

    public function getDescription()
    {
        return 'Покупка портфеля "' . $this->title . '"';
    }
}
