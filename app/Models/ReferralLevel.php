<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferralLevel extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'slug', 'achieve_challenges', 'remain_challenges'
    ];

    protected $casts = [
        'achieve_challenges' => 'array',
        'remain_challenges' => 'array',
    ];
}
