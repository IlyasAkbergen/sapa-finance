<?php

namespace App\Models;

use App\Interfaces\WithPurchase;
use App\Traits\HasPurchase;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCourse extends Model implements WithPurchase
{
    use HasFactory;
    use HasPurchase;

    protected $table = 'user_course';

    public function purchasable()
    {
        return $this->belongsTo(Course::class);
    }
}
