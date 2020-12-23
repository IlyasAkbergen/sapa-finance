<?php

namespace App\Models;

use App\Traits\HasUsers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    use HasUsers;

    protected $fillable = [
        'title', 'url', 'content', 'is_public', 'levels'
    ];

    protected $casts = [
        'levels' => 'array'
    ];

    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'model');
    }

    public function user_messages()
    {
        return $this->hasMany(UserMessage::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_message');
    }

    public function scopePublic($query)
    {
        return $query->where('is_public', true);
    }

    public function scopeForUser($query, $user_id)
    {
        return $query->whereHas('user_notifications', function ($q) use ($user_id) {
            $q->where('user_id', $user_id);
        });
    }

    public function scopeNewFor($query, $user_id)
    {
        return $query->whereHas('user_notifications', function ($q) use ($user_id) {
            $q->where('user_id', $user_id)
                ->where('seen', false);
        });
    }
}
