<?php

namespace App\Http\Middleware;

use Closure;
use Crawler;
use Config;
use Illuminate\Http\Request;

class NoSessionForBotsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Crawler::isCrawler()) {
            Config::set('session.driver', 'array');
        }

        return $next($request);
    }
}
