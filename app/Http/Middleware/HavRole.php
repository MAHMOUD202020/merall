<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HavRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next , $role)
    {
        $auth = \auth()->user();

        $roles = $auth->roles->map->name->all();

        if (in_array($role, $roles)) {

            return $next($request);

        }else{

            return  abort(401 );
        }

    }
}
