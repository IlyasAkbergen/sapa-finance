<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'eid', 'status', 'payable_id', 'payable_type', 'redirect_url', 'sum'
    ];

    public function payable()
    {
        return $this->morphTo();
    }
}
