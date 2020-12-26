<?php

namespace App\Models;

use App\Interfaces\WithPurchase;
use App\Traits\Awardable;
use App\Traits\HasUsers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Course extends Model implements WithPurchase
{
    use HasFactory;
    use Awardable;
    use SoftDeletes;

    const START_COURSE_TAG = 'is_became_agent';

    protected $fillable = [
        'title', 'short_description', 'description', 'direct_fee', 'direct_points', 'team_points', 'awardable',
        'price_without_feedback', 'price_with_feedback', 'is_online', 'is_offline',
        'image_path'
    ];

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
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

    public function users_pivot()
    {
        return $this->hasMany(UserCourse::class);
    }

    public function auth_user_pivot()
    {
        return $this->hasOne(UserCourse::class)
            ->where('user_id', Auth::user()->id);
    }

    public function getIsPartPaidAttribute()
    {
        return false;
    }

    public function getProgressPercentAttribute()
    {
        return !empty($this->pivot) ? $this->pivot->progress : 0;
    }

    public function getMyProgressAttribute()
    {
        $this->loadMissing('lessons.auth_user_homework');

        $lessons_count = $this->lessons->count();

        $passed_lessons_count = $this->lessons->filter(function ($item) {
            return isset($item->auth_user_homework)
                && !empty($item->auth_user_homework->score);
        })->count();

        if ($passed_lessons_count == 0 || $lessons_count == 0) {
            return 0;
        }

        return $passed_lessons_count * 100 / $lessons_count;
    }
}
