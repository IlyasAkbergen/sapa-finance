<?php

namespace App\Models;

use App\Interfaces\WithPurchase;
use App\Traits\HasPurchase;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBriefcase extends Model implements WithPurchase
{
    use HasFactory;
    use HasPurchase;

    protected $table = 'user_briefcase';

    public function purchasable()
    {
        return $this->belongsTo(Briefcase::class);
    }
}
