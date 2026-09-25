<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = auth('admin')->user();

        if (!$user || !in_array($user->role, $roles)) {
            abort(403, 'You do not have permission to access this page.');
        }

        return $next($request);
    }
}
