<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;

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
            Session::put('route-redirect', $request->route()->getName());
            return redirect()->route('admin.reauth.show');
        } elseif (auth()->user()->is_admin == TRUE && session()->get('reauth') == TRUE) {
            // Forget a single key.
            Session::forget('route-redirect');
            return $next($request);
        } else {
            abort(403);
        }
    }
}
