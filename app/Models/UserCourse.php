<?php

namespace App\Models;

use App\Traits\HasPurchase;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCourse extends Model
{
    use HasFactory;
    use HasPurchase;

    protected $table = 'user_course';
}
