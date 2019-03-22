<?php

namespace App\Http\Middleware;

use Closure;

class UpdateProfileMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure                  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $userType)
    {
        if($request->user()->updateProfileNeeded()){
            return response()->view('user.'.$userType.'.createProfile');
        }
        return $next($request);

    }
}
