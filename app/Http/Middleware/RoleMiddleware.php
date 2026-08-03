<?php

namespace App\Http\Middleware;

use App\Exceptions\ApiException;
use App\Models\Role;
use App\Models\User;
use Closure;

class RoleMiddleware
{
    public function handle($request, Closure $next, string $role)
    {

        $user = auth()->user();
        $userRole = Role::where('id', $user->role_id)->select('role')->firstOrFail();
        if (!$user) {
            throw new ApiException(
                'UNAUTHORIZED',
                'You must be logged in.',
                401
            );
        }

        if ($userRole->role !== $role) {
            throw new ApiException(
                'FORBIDDEN',
                'You are not authorized to perform this action.',
                403
            );
        }

        return $next($request);
    }
}
