<?php

namespace App\Http\Middleware;

use App\Enums\ReferralLevelEnum;
use App\Models\Role;
use Closure;
use Illuminate\Http\Request;

class CanRateHomework
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $levels = collect([
            ReferralLevelEnum::Agent,
            ReferralLevelEnum::Consultant,
            ReferralLevelEnum::Mentor,
            ReferralLevelEnum::Tutor,
            ReferralLevelEnum::Partner,
        ]);

        if ($request->user()->role_id == Role::ROLE_ADMIN
            || ($levels->contains($request->user()->referral_level_id)
            && $request->user()->referrals()->exists())) {
            return $next($request);
        }

        return redirect(route('courses-crud.index'));
    }
}
