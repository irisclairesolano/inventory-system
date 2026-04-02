<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        /** @var \Illuminate\Contracts\Auth\StatefulGuard $auth */
        $auth = auth();

        if (!$auth->check()) {
            return redirect('/login');
        }

        if ($auth->user()->role !== $role) {
            abort(403, 'Access denied. You do not have permission to view this page.');
        }

        return $next($request);
    }
}
