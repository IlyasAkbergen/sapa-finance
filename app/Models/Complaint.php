<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;

    protected $fillable = [
        'from_id', 'to_id', 'content'
    ];

    public function to_user()
    {
        return $this->belongsTo(User::class, 'to_id');
    }

    public function from_user()
    {
        return $this->belongsTo(User::class, 'from_id');
    }
}
