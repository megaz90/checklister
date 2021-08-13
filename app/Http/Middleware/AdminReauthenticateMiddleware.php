<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminReauthenticateMiddleware
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
        if (auth()->user()->is_admin == TRUE && session()->get('reauth') != TRUE) {
            return redirect()->route('admin.reauth.show');
        } elseif (auth()->user()->is_admin == TRUE && session()->get('reauth') == TRUE) {
            return $next($request);
        } else {
            abort(403);
        }
    }
}
