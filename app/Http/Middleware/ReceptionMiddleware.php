<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ReceptionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->user()->isApiReception()) {

            return response()->json([
                'status' => false,
                'message' => 'You are not an Reception',
                'statusCode' => 405,
                'data' => null
            ], 405);

        } else {
            return $next($request);
        }
    }
}
