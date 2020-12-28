<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LoginControl
{
    public function handle(Request $request, Closure $next)
    {
        if($request->session()->get('admin_id')==NULL){
            return redirect()->route('login');
        }
        return $next($request);
    }
}
