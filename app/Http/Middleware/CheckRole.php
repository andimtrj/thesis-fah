<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $roleCode): Response
    {
        if (Auth::check() && Auth::user()->role->role_code === $roleCode) {
            return $next($request); // Passes the request to the next layer.
        }

        return abort(403, 'Unauthorized');
    }
}
