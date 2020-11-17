<?php

namespace App\Models;

use App\Traits\Awardable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    use Awardable;

    protected $fillable = [
        'title', 'description'
    ];

    public function lessons()
    {
        $this->hasMany(Lesson::class);
    }
}
