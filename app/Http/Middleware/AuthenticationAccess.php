<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\Response;

class AuthenticationAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Pre-Middleware Action
        $secrets = explode(",", config('auth.secrets'));

        if($request->hasHeader('Service-Authorization')) {
            if(in_array($request->header('Service-Authorization'), $secrets)) {
                return $next($request);
            }
        }

        abort(Response::HTTP_UNAUTHORIZED, "Unauthorized");
    }
}
