<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 26.01.2021
 * Time: 20:38
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'from_id', 'to_id', 'content'
    ];

    protected $casts = [
        'created_at' => 'datetime:d.m.Y'
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