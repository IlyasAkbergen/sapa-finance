<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'content', 'author_id'
    ];

    public function author()
    {
        return $this->belongsTo(User::class);
    }

    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'model');
    }

    public function image()
    {
        return $this->morphOne(Attachment::class, 'model');
    }

    public function getImageLinkAttribute()
    {
        $this->loadMissing('image');
        return $this->image->link;
    }
}
