<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBriefcase extends Model
{
    use HasFactory;

    protected $table = 'user_briefcase';

    const STATUS_PENDING = 1;
    const STATUS_ACCEPTED = 2;
    const STATUS_REJECTED = 3;
    const STATUS_CLOSED = 4;

    protected $fillable = [
      'user_id', 'briefcase_id', 'consultant_id', 'status', 'contract_number', 'sum', 'profit', 'duration', 'monthly_payment'
    ];

    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function briefcase()
    {
        return $this->belongsTo(Briefcase::class);
    }
}
