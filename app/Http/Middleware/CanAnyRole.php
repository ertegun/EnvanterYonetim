<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CanAnyRole
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
        $roles = array_slice(func_get_args(), 2);
        foreach($roles as $role){
            if($request->user()->can($role)){
                return $next($request);
            }
        }
        return redirect()->route('homepage');
    }
}
