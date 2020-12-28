<?php

namespace App\Http\Middleware\Owner;

use Closure;
use Illuminate\Http\Request;
use App\Models\Owner;

class OwnerDelete
{
    public function handle(Request $request, Closure $next)
    {
        $control    =   Owner::where("id",$request->id)->count();
        if($control==0){
            return redirect()->back()->withCookie(cookie('error', 'Donanım İade İşlemi Başarısız!',0.02));
        }
        $control    =   Owner::where("bn",$request->bn)->count();
        if($control==0){
            return redirect()->back()->withCookie(cookie('error', 'Donanım İade İşlemi Başarısız!',0.02));
        }
        return $next($request);
    }
}
