<?php

namespace App\Models;

use App\Events\PenaltyCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penalty extends Model
{
    use HasFactory;

    protected $dispatchesEvents = [
//        'created' => PenaltyCreated::class
    ];

    protected $fillable = [
        'user_id', 'direct_points', 'team_points', 'handled'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
