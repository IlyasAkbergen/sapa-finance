<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title', 'content', 'author_id',
        'created_at', 'image_path', 'video_url'
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
}
