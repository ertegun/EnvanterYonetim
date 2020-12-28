<?php

namespace App\Http\Middleware\Owner;

use Closure;
use Illuminate\Http\Request;
use App\Models\Software;

class OwnerSoftDelete
{
    public function handle(Request $request, Closure $next)
    {
        $control    =   Software::where("owner_id",$request->user_id)->count();
        if($control==0){
            return redirect()->back()->withCookie(cookie('error', 'Yazılım İade İşlemi Başarısız!!',0.02));
        }
        $control    =   Software::find($request->soft_id);
        if($control==NULL){
            return redirect()->back()->withCookie(cookie('error', 'Yazılım İade İşlemi Başarısız!!',0.02));
        }
        return $next($request);
    }
}
