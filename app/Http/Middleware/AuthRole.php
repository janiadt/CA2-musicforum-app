<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Making a middleware that checks if the requested user doesnt exist or if they don't have the chosen roles
        if (!$request->user() || !$request->user()->hasTheseRoles($roles)) {
            // If they're not the correct user we'll just return them to the main route
            return redirect()->route('threads.index');
        }

        return $next($request);
    }
}
