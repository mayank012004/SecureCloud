<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // User must be authenticated
        if (!session()->has('cognito_user')) {
            return redirect('/login');
        }

        // User must have admin role
        if (session('local_user_role') !== 'admin') {
            abort(403, 'Access denied. Admin privileges required.');
        }

        return $next($request);
    }
}
