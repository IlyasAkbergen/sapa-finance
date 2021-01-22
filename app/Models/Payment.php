<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    const PAYMENT_STATUS_CREATED = 'created';
    const PAYMENT_STATUS_OK = 'ok';

    protected $casts = [
        'updated_at' => 'datetime:d.m.Y H:i',
    ];

    protected $fillable = [
        'eid', 'status', 'payable_id', 'payable_type', 'redirect_url', 'sum', 'user_id', 'paid_at', 'note', 'partner_id'
    ];

    public function payable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
