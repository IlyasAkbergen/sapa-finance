<?php

namespace App\Http\Middleware;

use App\Enums\ReferralLevelEnum;
use App\Models\Role;
use Closure;
use Illuminate\Http\Request;

class IsAdmin
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
        if (empty($request->user()) || $request->user()->role_id != Role::ROLE_ADMIN) {
            if ($request->user()->referral_level_id == ReferralLevelEnum::Partner) {
                return redirect(route('partner-cabinet.index'));
            }
            return redirect('/');
        }

        return $next($request);
    }
}
