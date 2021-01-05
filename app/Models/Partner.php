<?php

namespace App\Models;

use App\Enums\ReferralLevelEnum;
use App\Scopes\PartnerLevelScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Partner extends User
{
    use HasFactory;

    protected $table = 'users';

    protected $attributes = [
        'role_id' => Role::ROLE_CLIENT,
        'referral_level_id' => ReferralLevelEnum::Partner
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new PartnerLevelScope);

        static::creating(function ($query) {
            if (empty($query->iin)) {
                $query->iin = Str::random(10);
            }
        });
    }
}
