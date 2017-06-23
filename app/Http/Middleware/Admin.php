<?php

namespace App\Http\Middleware;

use Closure;

class Admin
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
        echo ("authenticated");
        if($user->admin) 
        {
            return $next($request); // allow admin to continue to desination
        }

        return redirect()->intended('/'); // send user to home page
        
    }
}
