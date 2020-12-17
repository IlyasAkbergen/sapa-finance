<?php

namespace App\Http\Middleware;

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

        return $next($request);
    }
}
