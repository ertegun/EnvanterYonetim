<?php

namespace App\Http\Middleware\Owner;


use App\Models\Software;
use Closure;
use Illuminate\Http\Request;

class OwnerSoftDeleteView
{
    public function handle(Request $request, Closure $next)
    {
        $control    =   Software::find($request->id);
        if($control==NULL){
            return redirect()->back();
        }
        return $next($request);
    }
}

