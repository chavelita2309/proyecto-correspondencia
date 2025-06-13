<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // app/Http/Middleware/RoleMiddleware.php
    public function handle($request, Closure $next, $role)
    {
         if (!Auth::check()) return redirect('login');

        if (!$request->user()->roles->contains('nombre', $role)) {
            abort(403, 'No tienes acceso a esta sección.');
        }

        return $next($request);
    }
}
