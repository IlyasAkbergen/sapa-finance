<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserBriefcase extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'user_briefcase';

    const STATUS_PENDING = 1;
    const STATUS_ACCEPTED = 2;
    const STATUS_REJECTED = 3;
    const STATUS_CLOSED = 4;

    protected $fillable = [
        'user_id', 'briefcase_id', 'consultant_id', 'status',
        'contract_number', 'sum', 'profit', 'duration',
        'monthly_payment', 'purchase_id', 'created_at'
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

    public static function nextContractNumber()
    {
        $last_briefcase = self::whereNotNull('contract_number')
            ->orderByDesc('contract_number')
            ->first();
        return data_get($last_briefcase, 'contract_number') + 1;
    }
}
