<?php

namespace App\Http\Middleware;

use App\Http\Resources\AuthUserResource;
use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Inertia\Inertia;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('welcome');
        }
    }

    public function handle($request, Closure $next, ...$guards)
    {
        $this->authenticate($request, $guards);

        if (!empty($request->user())) {
            $request->user()->loadMissing([
                'balance', 'referrer.referral_level', 'referral_level'
            ]);
        }

        return $next($request);
    }
}
