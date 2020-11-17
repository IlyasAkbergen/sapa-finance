<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'text', 'url'
    ];

    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'model');
    }
}
