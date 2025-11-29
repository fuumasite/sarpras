<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check kung ang user ay HINDI admin
        if ($request->user()->role !== 'admin') {
            // Kung user ka at tinry mo i-access ang admin page, abort 403 (Forbidden)
            abort(403, 'UNAUTHORIZED ACCESS: Admins only.');
        }

        return $next($request);
    }
}
