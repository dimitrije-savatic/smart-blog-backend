<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class OptionalAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Try Sanctum authentication
        if ($request->bearerToken()) {
            Auth::shouldUse('sanctum');

            $user = $request->user('sanctum');

            if ($user) {
                Auth::setUser($user);
            }
        }

        return $next($request);
    }
}
