<?php

namespace App\Http\Middleware;

use Closure;

class Install
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (file_exists(base_path() . '/storage/installed'))
            return redirect()->route('frontend.index');

        return $next($request);
    }
}
