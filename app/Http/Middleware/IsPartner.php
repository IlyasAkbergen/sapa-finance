<?php

namespace App\Http\Middleware;

use App\Enums\ReferralLevelEnum;
use App\Models\Role;
use Closure;
use Illuminate\Http\Request;

class IsPartner
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
        if ($request->user()->role_id != Role::ROLE_PARTNER) {
            return redirect('/');
        }

        return $next($request);
    }
}
