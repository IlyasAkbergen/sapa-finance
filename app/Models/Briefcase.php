<?php

namespace App\Models;

use App\Interfaces\WithPurchase;
use App\Traits\Awardable;
use App\Traits\HasUsers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Briefcase extends Model implements WithPurchase
{
    use HasFactory;
    use Awardable;
    use SoftDeletes;

    protected $fillable = [
        'title', 'description', 'type_id',
//        'sum', 'profit', 'duration',
//        'monthly_payment', 'direct_fee', 'awardable',
        'image_path', 'partner_id', 'fee_percent'
    ];

    protected $attributes = [
        'awardable' => true,
        'direct_fee' => 0
    ];

    public function getAwardableAttribute()
    {
        return true;
    }

    public function type()
    {
        return $this->belongsTo(BriefcaseType::class);
    }

    function purchases()
    {
        return $this->morphMany(Purchase::class, 'purchasable');
    }

    public function getDescription()
    {
        return 'Покупка портфеля "' . $this->title . '"';
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_briefcase');
    }

    function getPurchaseSum($with_feedback)
    {
        return 0;
    }

    function getIsPartPaidAttribute()
    {
        return $this->type_id == 1;
    }

    public function auth_user_pivot()
    {
        return $this->hasOne(UserBriefcase::class)
            ->where('user_id', Auth::user()->id);
    }

    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }

    function getLinkAttribute()
    {
        return Auth::user()->role_id == Role::ROLE_ADMIN
            ? route('briefcases-admin.edit', $this->id)
            : route('briefcases.show', $this->id);
    }

    function active_change()
    {
        return $this->changes()
            ->where('status', BriefcaseChange::STATUS_CREATED);
    }

    function changes()
    {
        return $this->hasMany(BriefcaseChange::class);
    }
}
