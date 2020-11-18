<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCourse extends Model
{
    use HasFactory;

    protected $table = 'user_course';

    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }
}
