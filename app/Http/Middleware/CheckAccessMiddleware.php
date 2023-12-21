<?php

namespace App\Http\Middleware;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Closure;

class CheckAccessMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!Auth::guard('api')->check()) {
            return response('Unauthorized', Response::HTTP_UNAUTHORIZED);
        }

        return $next($request);
    }
}