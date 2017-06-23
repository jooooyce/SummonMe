<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class AdminOnly
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
        $user = Auth::user();
            //echo ($user);
            if (isset($user))
            {
                if($user->admin) 
                {
                    return $next($request); // allow admin to continue to desination
                }
                else
                {

                    return redirect()->intended('/'); // send user back to home page
                }
            }
            else
            {
                return redirect()->intended('/');
            }
    }
}
