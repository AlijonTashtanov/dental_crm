<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;

class LocaleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(Request): (Response|RedirectResponse) $next
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $lang = $request->header('Accept-Language');
        $languages = config('app.languages');
        if (in_array($lang, $languages)) {
            App::setLocale($lang);
        } else {
            App::setLocale('uz');
        }
        return $next($request);
    }
}
