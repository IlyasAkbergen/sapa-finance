<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    const ROLE_ADMIN = 1;
    const ROLE_CLIENT = 2;
    const ROLE_AGENT = 3;
    const ROLE_CONSULTANT = 4;

    public $timestamps = false;

    protected $fillable = [
        'name'
    ];
}
