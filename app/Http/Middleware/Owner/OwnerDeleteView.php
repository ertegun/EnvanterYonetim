<?php

namespace App\Http\Middleware\Owner;

use App\Models\Owner;
use Closure;
use Illuminate\Http\Request;

class OwnerDeleteView
{
    public function handle(Request $request, Closure $next)
    {
        $control    =   Owner::where('bn',$request->bn)->count();
        if($control==0){
            return redirect()->back();
        }
        return $next($request);
    }
}

