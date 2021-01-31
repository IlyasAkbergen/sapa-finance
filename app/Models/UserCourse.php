<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCourse extends Model
{
    use HasFactory;

    protected $table = 'user_course';

    protected $fillable = [
        'user_id', 'course_id', 'progress',
        'score', 'completed', 'paid', 'status',
        'consultant_id'
    ];

    protected $dispatchesEvents = [
        // 'completed' => todo realize
    ];

    const STATUS_PENDING = 1;
    const STATUS_ACCEPTED = 2;
    const STATUS_REJECTED = 3;
    const STATUS_CLOSED = 4;

    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    function makeCompleted()
    {
        $this->update([
            'completed' => true
        ]);

        // $this->fireModelEvent('completed'); todo use
    }
}
