<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'path', 'model_id', 'model_type', 'uuid', 'user_id'
    ];

    public function attachable()
    {
        return $this->morphTo();
    }
}
