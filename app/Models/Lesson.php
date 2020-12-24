<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'course_id',
        'video_url',
        'order',
        'homework_content'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'model');
    }

    public function homeworks()
    {
        return $this->hasMany(Homework::class);
    }

    public function auth_user_homework()
    {
        return $this->hasOne(Homework::class)
            ->where('user_id', Auth::user()->id);
    }

    public function getPassedAttribute()
    {
        return isset($this->auth_user_homework)
            && !empty($this->auth_user_homework->score);
    }

    public function getEnabledAttribute()
    {
        return isset($this->auth_user_homework);
    }

    public function getHasNextLessonAttribute()
    {
        $this->loadMissing('course.lessons');
        return $this->course->lessons->contains(function($item) {
            return $item->order > $this->order;
        });
    }
}
