<?php

namespace App\Http\Middleware\Api;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ApiAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return JsonResponse|RedirectResponse|Response
     */
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->user()->isApiAdmin()) {
            return response()->json([
                'status' => false,
                'message' => 'You are not an admin',
                'statusCode' => 405,
                'data' => null
            ], 405);
        } else {
            return $next($request);
        }
    }
}
