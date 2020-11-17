<?php

namespace App\Models;

use App\Traits\Awardable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Briefcase extends Model
{
    use HasFactory;
    use Awardable;

    protected $fillable = [
        'title', 'description', 'type_id', 'sum', 'profit', 'duration', 'monthly_payment'
    ];
}
