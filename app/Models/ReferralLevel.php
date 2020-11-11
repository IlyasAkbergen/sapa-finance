<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferralLevel extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'target_points'];

    const LEVEL_AGENT = 1;
    const LEVEL_CONSULTANT = 2;
}
