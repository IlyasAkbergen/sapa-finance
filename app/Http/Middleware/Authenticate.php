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
        if (auth()->guest()) {
            return redirect()->route('welcome')->setStatusCode(401);
        }
        $this->authenticate($request, $guards);

        if (!empty($request->user())) {
            $request->user()->loadMissing([
                'balance', 'referrer.referral_level', 'referral_level', 'active_course'
            ]);
        }

        return $next($request);
    }
}
