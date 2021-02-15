<?php

namespace App\Http\Middleware;

use App\Models\Reset;
use Closure;
use Illuminate\Http\Request;

class ResetPassword
{
    public function handle(Request $request, Closure $next)
    {
        $control = Reset::where('token',$request->token)->count();
        if($control == NULL){
            return redirect()->route('login');
        }
        return $next($request);
    }
}
