<?php

namespace App\Http\Middleware\Type;

use Closure;
use Illuminate\Http\Request;
use App\Models\Type;

class TypeView
{
    public function handle(Request $request, Closure $next)
    {
        $control    =   Type::find($request->id);
        if($control==NULL){
            return redirect()->route('type');
        }
        return $next($request);
    }
}

