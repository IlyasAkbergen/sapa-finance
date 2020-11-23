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

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
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
