<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BriefcaseType extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'title', 'description'
    ];

    const TYPE_CUMULATIVE = 1;
    const TYPE_ONE_TIME = 2;
}
