<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;

class CheckRoleExistMiddleware
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
        $role = Role::find(1);
        if (!$role) {
            return redirect()->route('admin.roles.create')->with('info', 'Role needs to be created first!');
        }
        return $next($request);
    }
}
