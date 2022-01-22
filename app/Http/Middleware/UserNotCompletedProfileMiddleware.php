<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class UserNotCompletedProfileMiddleware
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
        if (
            $request->user()->photo_path ||
            $request->user()->description ||
            $request->user()->completed_profile
        ) {
            return redirect()->intended(URL::route('profile.show', ['user' => $request->user()->id]));
        }

        return $next($request);
    }
}
