<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role): mixed
    {
        if (!$request->user() || $request->user()->role !== $role) {
            return response()->json([
                'message' => 'Access denied. You do not have the required permissions.'
            ], 403);
        }

        return $next($request);
    }
}
