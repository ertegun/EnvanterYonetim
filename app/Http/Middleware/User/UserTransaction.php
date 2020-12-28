<?php

namespace App\Http\Middleware\User;

use Closure;
use Illuminate\Http\Request;
use App\Models\User\User;

class UserTransaction
{
    public function handle(Request $request, Closure $next)
    {
        $control    =   User::find($request->id);
        if($control==NULL){
            return redirect()->route('user');
        }
        return $next($request);
    }
}

