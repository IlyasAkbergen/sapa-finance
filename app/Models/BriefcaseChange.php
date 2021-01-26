<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BriefcaseChange extends Model
{
    use HasFactory, SoftDeletes;

    const TYPE_CREATE = 1;
    const TYPE_EDIT = 2;
    const TYPE_DELETE = 3;

    const STATUS_CREATED = 1;
    const STATUS_ACCEPTED = 2;
    const STATUS_REJECTED = 3;

    protected $fillable = [
        'briefcase_id', 'partner_id', 'change_data', 'status', 'type_id'
    ];

    protected $casts = [
        'change_data' => 'array',
    ];

    public function briefcase()
    {
        return $this->belongsTo(Briefcase::class)->withTrashed();
    }

    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }
}
