<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Attachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'path', 'model_id', 'model_type', 'uuid', 'user_id', 'name', 'slug'
    ];

    public function attachable()
    {
        return $this->morphTo();
    }

    public function getLinkAttribute()
    {
        return url(Storage::url($this->path));
    }
}
