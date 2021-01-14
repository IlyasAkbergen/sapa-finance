<?php

namespace App\Models;

use App\Challenges\Contracts\Challengable;
use App\Events\ReferralLevelUpdated;
use App\Traits\Challengable as ChallengableTrait;
use App\Traits\HasReferrals;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements Challengable, MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasReferrals;
    use ChallengableTrait;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'iin', 'password', 'balance_id',
        'referrer_id', 'root_referer_id', 'referral_level_id',
        'profile_photo_path', 'description', 'bin', 'role_id', 'partner_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    protected $dispatchesEvents = [
        'level_updated' => ReferralLevelUpdated::class
    ];

    protected $attributes = [
        'password' => 'password'
    ];

    const POINTS_PER_REFERRAL = 15;
    const POINTS_PER_GRAND_REFERRAL = 10;

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function briefcases()
    {
        return $this->belongsToMany(Briefcase::class, 'user_briefcase')
            ->withPivot('status', 'progress', 'completed');
    }

    public function courses()
    {
        return $this->belongsToMany(
            Course::class, 'user_course'
        )->withPivot('score', 'status', 'progress', 'completed');
    }

    public function newMessages()
    {
        return $this->messages()
            ->wherePivot('seen', false);
    }

    public function messages()
    {
        return $this->belongsToMany(Message::class, 'user_message')
            ->withPivot(['seen']);
    }

    public function balance()
    {
        return $this->belongsTo(Balance::class);
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

    public function payouts()
    {
        return $this->hasMany(Payout::class);
    }

    public function updateReferralLevel($new_level_id)
    {
        $updated = $this->update([
            'referral_level_id' => $new_level_id
        ]);

        if ($updated) {
            $this->fireModelEvent('level_updated');
        }

        return $updated;
    }

    public function getDirectPointsAttribute()
    {
        return $this->getDirectPoints();
    }

    public function getTeamPointsAttribute()
    {
        return $this->getTeamPoints();
    }

    public function active_course()
    {
        return $this->belongsToMany(Course::class, 'user_course')
            ->withPivot(['paid', 'completed', 'progress'])
            ->wherePivot('paid', true)
            ->wherePivot('completed', false);
    }

    public function getReferralLinkAttribute() {
        return url('/?referrer_id='.$this->id);
    }
    public static function updateReferral($user_id, $id)
    {
        $user = User::find($user_id);
        $user->referrer_id = $id;
        return $user->update();
    }


    public function getIsAdminAttribute()
    {
        return $this->role_id == Role::ROLE_ADMIN;
    }

    public function getIsPartnerAttribute()
    {
        return $this->role_id == Role::ROLE_PARTNER;
    }
}
