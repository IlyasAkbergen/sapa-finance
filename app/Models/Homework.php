<?php

namespace App\Models;

use App\Events\HomeworkCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Homework extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'lesson_id', 'score', 'status', 'content'
    ];

    protected $dispatchesEvents = [
//        'created' => HomeworkCreated::class
    ];

    const ATTACHMENT_MAIN_DIR = 'homeworks';
    const STATUS_ACCEPTED = 1;
    const STATUS_REJECTED = 1;

    public function getLinkAttribute()
    {
        return url('/');
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function course()
    {
        return $this->hasOneThrough(
            Course::class,
            Lesson::class,
            'id',
            'id',
            'lesson_id',
            'course_id'
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function attachments()
    {
        return $this->morphMany(
            Attachment::class, 'model'
        );
    }
}
