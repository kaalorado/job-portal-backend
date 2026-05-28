<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApplicantMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response{
        if ($request->user()->role !== 'applicant') {
            return response()->json([
                'message' => 'Access denied. Applicants only.'
            ], 403);
        }

        return $next($request);

    }
}
