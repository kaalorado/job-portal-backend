<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EmployerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response {

        if ($request->user()->role !== 'employer') {
            return response()->json([
                'message' => 'Access denied. employer only.'
            ], 403);
        }

        return $next($request);
    }
}
