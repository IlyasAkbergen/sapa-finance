<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCourse extends Model
{
    use HasFactory;

    protected $table = 'user_course';

    protected $dispatchesEvents = [
        // 'completed' => todo realize
    ];


    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }

    function makeCompleted()
    {
        $this->update([
            'completed' => true
        ]);

        // $this->fireModelEvent('completed'); todo use
    }
}
