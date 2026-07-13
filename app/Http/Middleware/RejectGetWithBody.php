<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RejectGetWithBody
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->isMethod('GET')) {

            // Detect raw body (most reliable)
            $hasRawBody = strlen(trim($request->getContent())) > 0;

            // Detect parsed input (fallback)
            $hasInput = !empty($request->all());

            if ($hasRawBody || $hasInput) {
                return response()->json([
                    'message' => 'GET requests must not contain a request body.',
                    'status' => 400
                ], 400);
            }
        }
        return $next($request);
    }
}
