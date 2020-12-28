<?php

namespace App\Http\Middleware;

use App\Enums\ReferralLevelEnum;
use App\Models\Role;
use Closure;
use Illuminate\Http\Request;

class IsClient
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
        if ($request->user()->role_id != Role::ROLE_CLIENT) {
            if ($request->user()->role_id == Role::ROLE_ADMIN) {
                return redirect(route('courses-crud.index'));
            }
        }
        if ($request->user()->referral_level_id == ReferralLevelEnum::Partner) {
            return redirect(route('partner-cabinet.index'));
        }

        return $next($request);
    }
}
