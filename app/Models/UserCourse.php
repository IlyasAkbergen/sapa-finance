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
        'score', 'completed', 'paid', 'status'
    ];

    protected $dispatchesEvents = [
        // 'completed' => todo realize
    ];


    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    function makeCompleted()
    {
        $this->update([
            'completed' => true
        ]);

        // $this->fireModelEvent('completed'); todo use
    }
}
