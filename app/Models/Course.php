<?php

namespace App\Models;

use App\Interfaces\WithPurchase;
use App\Traits\Awardable;
use App\Traits\HasUsers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model implements WithPurchase
{
    use HasFactory;
    use Awardable;

    const START_COURSE_ID = 1;

    protected $fillable = [
        'title', 'description', 'direct_fee', 'awardable',
        'price_without_feedback', 'price_with_feedback', 'is_online'
    ];

    public function lessons()
    {
        $this->hasMany(Lesson::class);
    }

    public function getPurchaseSum($with_feedback)
    {
        return $with_feedback
            ? $this->price_with_feedback
            : $this->price_without_feedback;
    }

    public function purchases()
    {
        return $this->morphMany(Purchase::class, 'purchasable');
    }

    public function getDescription()
    {
        return 'Покупкка курса "' . $this->title . '"';
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_course');
    }

    function getIsPartPaidAttribute()
    {
        return false;
    }
}
