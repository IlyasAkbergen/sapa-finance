<?php

namespace App\Models;

use App\Events\HomeworkCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Homework extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'lesson_id', 'score'
    ];

    protected $dispatchesEvents = [
        'created' => HomeworkCreated::class
    ];

    const ATTACHMENT_MAIN_DIR = 'homeworks';

    public function getLinkAttribute()
    {
        return url('/'); // todo dynamic route to homework
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
        return $this->morphMany(Attachment::class, 'model');
    }
}
