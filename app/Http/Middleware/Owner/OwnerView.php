<?php

namespace App\Http\Middleware\Owner;

use App\Models\User\User;
use Closure;
use Illuminate\Http\Request;

class OwnerView
{
    public function handle(Request $request, Closure $next)
    {
        $control    =   User::find($request->id);
        if($control==NULL){
            return redirect()->back();
        }
        return $next($request);
    }
}

