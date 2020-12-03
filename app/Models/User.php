<?php

namespace App\Models;

use App\Challenges\Contracts\Challengable;
use App\Events\ReferralLevelUpdated;
use App\Traits\Challengable as ChallengableTrait;
use App\Traits\HasReferrals;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements Challengable // todo uncomment MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasReferrals;
    use ChallengableTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'iin', 'password', 'balance_id',
        'referrer_id', 'root_referer_id', 'referral_level_id'
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

    const POINTS_PER_REFERRAL = 15;
    const POINTS_PER_GRAND_REFERRAL = 10;

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function briefcases()
    {
        return $this->belongsToMany(Briefcase::class);
    }

    public function courses()
    {
        return $this->belongsToMany(
            Course::class, 'user_course'
        );
    }

    public function newNotifications()
    {
        return $this->notifications()
            ->wherePivot('seen', false);
    }

    public function notifications()
    {
        return $this->belongsToMany(Notification::class);
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
}
