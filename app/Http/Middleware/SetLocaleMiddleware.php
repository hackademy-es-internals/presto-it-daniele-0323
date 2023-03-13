<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocaleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
        $acceptLang = ['es', 'it', 'en'];
        $lang = in_array($lang, $acceptLang) ? $lang : 'en';
        $localeLanguage = session('locale', $lang);
        App::setlocale($localeLanguage);
        return $next($request);
    }
}
