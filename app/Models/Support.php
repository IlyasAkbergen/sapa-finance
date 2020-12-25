<?php

namespace App\Models;

use App\Traits\HasUsers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    use HasFactory;
    use HasUsers;

    const ATTACHMENT_MAIN_DIR = 'support';

    protected $fillable = [
        'message', 'user_id'
    ];

    protected $casts = [
        'levels' => 'array'
    ];

    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'model');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
