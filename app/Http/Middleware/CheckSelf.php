<?php

namespace App\Http\Middleware;

use Closure;

class CheckSelf
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
        // $this->user = user being requested / updated
        // $this->user() = currently logged in user
        if ($request->user()->id != $request->user->id) {
            return redirect()->route('frontend.index');
        }

        return $next($request);
    }
}
