<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'text', 'url', 'content', 'is_public'
    ];

    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'model');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function user_notifications()
    {
        return $this->hasMany(UserNotification::class);
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
